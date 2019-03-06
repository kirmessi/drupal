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
use Drupal\Core\node\Entity\Node;
/**
* Provides an example resource to return the right Arnold movie quote.
*
* @RestResource(
*   id = "my_custom_resource_random",
*   label = @Translation("Random Arnold Movie Quote"),
*   uri_paths = {
*     "canonical" = "/api/custom/arnold/random",
*     "https://www.drupal.org/link-relations/create" = "/api/custom/arnold/random"
*   }
* )
*/
class MyCustomResourceRandom extends ResourceBase {
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
     // Load the arnold movie parameter.
     $movie = $this->request->get('arnold-movie');
     
     // Load nodes by movie.
     $query = \Drupal::entityQuery('node');
     $query->condition('status', 1);
     $query->condition('type', 'arnold_movies');
     $query->condition('field_movie', $movie);
     
     // Check if user is not able to access bonus quotes.
     if (!$this->currentUser->hasPermission('can access bonus quotes')) {
       // Restrict query to non-bonus.
       $query->condition('field_bonus', '0');
     } 
     
     // Load a random node IDs.
     $random_quote = Node::load(array_rand($query->execute()));
    
     // Process request.
     $quote = $random_quote ? $random_quote->title : 'No movie found';
     // Configure caching settings.
     $build = [
       '#cache' => [
         'max-age' => 0,
       ],
     ];
     
     // Return results.
     return (new ResourceResponse(['quote' => $quote], 200))->addCacheableDependency($build);
   }
 }
}