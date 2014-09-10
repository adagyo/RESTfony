<?php
namespace RESTfony\ApiBundle\Helpers;


class Response {
    public static function getLinks($router, $route_name, $total_count, $limit, $offset, $sort) {
        $links = '';
        if($total_count > $limit) {
            $page_count = ceil($total_count / $limit);
            // First page
            $links = '<' . $router->generate($route_name, array('limit' => $limit, 'offset' => 0, 'sort' => $sort), true) . '>; rel="first", ';
            // Prev page
            if($offset > 0) {
                $links .= '<' . $router->generate($route_name, array('limit' => $limit, 'offset' => $offset-$limit, 'sort' => $sort), true) . '>; rel="prev", ';
            }
            // Next page
            if(ceil($offset/$limit)+1 < $page_count) {
                $links .= '<' . $router->generate($route_name, array('limit' => $limit, 'offset' => $offset+$limit, 'sort' => $sort), true) . '>; rel="next", ';
            }
            // Last page
            $links .= '<' . $router->generate($route_name, array('limit' => $limit, 'offset' => ($page_count-1)*$limit, 'sort' => $sort), true) . '>; rel="last"';
        }
        return $links;
    }

    public static function getSort($sort, $document) {
        $aSort = Array();
        foreach(explode(',',$sort) as $field) {
            $order = 'ASC';
            $field = trim($field);
            if($field[0] == '-') {
                $order = 'DESC';
                $field = substr($field,1);
            } elseif($field[0] == '+') {
                $field = substr($field,1);
            }

            if(property_exists(new $document(), $field)) {
                $aSort[$field] = $order;
            }
        }
        return $aSort;
    }
} 