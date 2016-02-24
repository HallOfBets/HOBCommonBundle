<?php
namespace HOB\CommonBundle\Pagination;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class Pagination
 * @package HOB\CommonBundle\Pagination
 */
class Pagination
{
    /**
     * @var string
     */
    private $headerPrefix;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * PaginationResponse constructor.
     * @param $headerPrefix
     * @param RouterInterface $router
     */
    public function __construct($headerPrefix, RouterInterface $router)
    {
        $this->headerPrefix = $headerPrefix;
        $this->router       = $router;
    }

    /**
     * @param $route
     * @param integer $itemsNumber
     * @param array $urlParameters
     * @return array
     */
    public function getHeader($route, $itemsNumber, array $urlParameters)
    {
        $items       = $itemsNumber;
        $currentPage = $urlParameters['page'];
        $pageItems   = $urlParameters['pageItems'];
        $maxPage     = ceil($items/$pageItems);

        $links = [];
        $links['current'] = $currentPage;
        $links['count'] = $items;
        $links['pages'] = $maxPage;
        $links['first'] = $this->generateUrl($route, array_merge($urlParameters, ['page' => 1]));
        $links['prev']  = $currentPage > 1 ? $this->generateUrl($route, array_merge($urlParameters, ['page' => $currentPage-1])): 1;
        $links['next']  = $currentPage < $maxPage ? $this->generateUrl($route, array_merge($urlParameters, ['page' => $currentPage+1])): $maxPage;
        $links['last']  = $this->generateUrl($route, array_merge($urlParameters, ['page' => $maxPage]));

        $headers = [];

        foreach($links as $headerName => $headerValue) {
            $headerFullName = $this->headerPrefix.ucfirst($headerName);
            $headers[$headerFullName] = $headerValue;
        }

        return $headers;
    }

    /**
     * @param array $headers
     * @return array
     */
    public function getFromHeader(array $headers)
    {
        $pagination = [];

        foreach($headers as $headerName => $headerValue) {
            $paginationParamName = $this->extractHeaderPagination($headerName);

            if(!is_null($paginationParamName)) {
                $pagination[$paginationParamName] = current($headerValue);
            }
        }

        return $pagination;
    }

    /**
     * @param $headerName
     * @return null|string
     */
    private function extractHeaderPagination($headerName)
    {
        if($pos = strpos($headerName, $this->headerPrefix) !== false) {
            $paginationParameter = substr($headerName, ($pos-1+strlen($this->headerPrefix)));

            return strtolower($paginationParameter);
        }

        return null;
    }

    /**
     * @param $route
     * @param array $parameters
     * @return string
     */
    private function generateUrl($route, array $parameters)
    {
        return $this->router->generate($route, $parameters);
    }
}
