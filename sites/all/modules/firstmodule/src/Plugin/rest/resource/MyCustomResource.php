<?php
namespace Drupal\firstmodule\Plugin\rest\resource;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\Component\Utility\Html;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\search_api\Query\QueryInterface;
use Drupal\search_api\Entity\Index;
/**
* @RestResource(
*   id = "my_custom_resource",
*   label = @Translation("hello name"),
*   uri_paths = {
*     "canonical" = "/api/custom/test",
*     "https://www.drupal.org/link-relations/create" = "/api/custom/test"
*   }
* )
*/
class MyCustomResource extends ResourceBase {
 /**
  * A current user instance.
  *
  * @var \Drupal\Core\Session\AccountProxyInterface
  */
 protected $currentUser;
 /**
  * The request object that contains the parameters.
  *
  * @var \Symfony\Component\HttpFoundation\Request
  */
 protected $request;
 /**
  * Constructs a new object.
  *
  * @param array $configuration
  *   A configuration array containing information about the plugin instance.
  * @param string $plugin_id
  *   The plugin_id for the plugin instance.
  * @param mixed $plugin_definition
  *   The plugin implementation definition.
  * @param array $serializer_formats
  *   The available serialization formats.
  * @param \Psr\Log\LoggerInterface $logger
  *   A logger instance.
  * @param \Symfony\Component\HttpFoundation\Request $request
  *   The request object.
  * @param \Drupal\Core\Session\AccountProxyInterface $current_user
  *   A current user instance.
  */
 public function __construct(
   array $configuration,
   $plugin_id,
   $plugin_definition,
   array $serializer_formats,
   LoggerInterface $logger,
   AccountProxyInterface $current_user,
   Request $request) {
   parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
   $this->request = $request;
   $this->currentUser = $current_user;
 }
 /**
  * {@inheritdoc}
  */
 public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
   return new static(
     $configuration,
     $plugin_id,
     $plugin_definition,
     $container->getParameter('serializer.formats'),
     $container->get('logger.factory')->get('my_custom_log'),
     $container->get('current_user'),
     $container->get('request_stack')->getCurrentRequest()
   );
 }
 /**
  * Responds to GET requests.
  *
  * @return \Drupal\rest\ResourceResponse
  *   The HTTP response object.
  *
  * @throws \Symfony\Component\HttpKernel\Exception\HttpException
  *   Throws exception expected.
  */
 public function get() {
   if ($this->request) {
     // Load the hello parameter.
     $hello = $this->request->get('hello-world');
    
     // Process request.
     $answer = 'No Name found';
     switch ($hello) {
       case 'kir':
         $answer = 'Hello Kir!';
         break;
       case 'nix':
         $answer = 'Greate Company';
         break;
     }
     // Configure caching settings.
     $build = [
       '#cache' => [
         'max-age' => 0,
       ],
     ];
     
     // Return results.
     return (new ResourceResponse(['answer' => $answer], 200))->addCacheableDependency($build);
   }
 }
}