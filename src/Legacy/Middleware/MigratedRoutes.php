<?php

namespace Legacy\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Legacy\Factory;

class MigratedRoutes
{
    protected $redirect_to;

    protected $routes;
    /**
     * @var Factory
     */
    private $factory;

    public function __construct(Factory $factory) {

        $this->factory = $factory;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        $this->routes = config('legacy.migrated_routes', []);

        $path = $this->factory->getRequestedFile();

        if ($this->canRedirect($path)) {
            return redirect()->route($this->redirect_to, $request->query());
        }

        $this->abortIfNotExists($path);

        return $next($request);
    }

    private function abortIfNotExists(string $file) {
        $file_path = $this->factory->getFilePath($file);

        if (!file_exists($file_path)) {
            abort(Response::HTTP_NOT_FOUND);
        }
    }

    private function canRedirect($path) {
        return $this->redirect_to = $this->routes[$path] ?? '';
    }
}
