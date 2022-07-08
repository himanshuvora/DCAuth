<?

use Authorization\Middleware\UnauthorizedHandler\CakeRedirectHandler;

use Authorization\Exception\Exception;
use Cake\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Cake\Http\FlashMessage;

class CustomDenied extends CakeRedirectHandler
{
    /**
     * {@inheritDoc}
     *
     * Return a response with a location header set if an exception matches.
     */
    public function handle(
        Exception $exception,
        ServerRequestInterface $request,
        array $options = []
    ): ResponseInterface {
        $options += $this->defaultOptions;

        if (!$this->checkException($exception, $options['exceptions'])) {
            throw $exception;
        }
        if ($request->getAttribute('identity') === null) {
            $url = $this->getUrl($request, $options);
        } else {
            /**
             * @var ServerRequest $request
             */
            $url = $request->referer(false);
            (new FlashMessage($request->getSession()))->error('You do not have access');
        }
        $response = new Response();

        return $response
            ->withHeader('Location', $url)
            ->withStatus($options['statusCode']);
    }
}
