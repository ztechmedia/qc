<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Search
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function advanceSearch($params, $table, $dateField, $select, $order_by)
    {
        $this->ci->load->model("SearchModel", "Search");
        $limit = isset($params['limit']) ? htmlspecialchars($params['limit'], ENT_QUOTES, 'UTF-8') : 250;
        $page = isset($params['page']) ? htmlspecialchars($params['page'], ENT_QUOTES, 'UTF-8') : 1;

        unset($params["limit"]);
        unset($params["page"]);

        $totalRecords = $this->ci->Search->getTotal($params, $table, $dateField);
        $startIndex = ($page - 1) * $limit;
        $endIndex = $page * $limit;
        $pagination = [];

        if ($totalRecords > 0) {

            if ($endIndex < $totalRecords) {
                $pagination["next"] = [
                    "page" => $page + 1,
                ];
            }

            if ($startIndex > 0) {
                $pagination['prev'] = [
                    "page" => $page - 1,
                ];
            }
            $products = $this->ci->Search->getLimit($select, $params, $table, $dateField, $limit, $startIndex, $order_by);
        } else {
            $products = [];
        }

        $data['total'] = $totalRecords;
        $data['pagination'] = $pagination;
        $data['page'] = $page;
        $data["totalRecords"] = $totalRecords;
        $data["totalPage"] = ceil($totalRecords / $limit);
        $data['start'] = $startIndex + 1;
        $data['end'] = $startIndex + count($products);
        $data["products"] = $products;

        return $data;
    }
}
