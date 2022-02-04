<?php

namespace App\Controller;

use App\Curl\GithubCurl;
use App\Request\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->keyword;
        if (!is_null($request->created))
            $q .= "+created:>" . $request->created;
        else
            $q .= "+created:>2019-01-10";

        if (!is_null($request->language))
            $q .= "+language:" . strtolower($request->language);

        $result = (new GithubCurl())
            ->setParam('q', $q)
            ->setParam('sort', 'created')
            ->setParam('page', $request->page)
            ->setParam('order', $request->order)
            ->setParam('per_page', $request->per_page)
            ->getData();

        return json_decode($result);
    }
}
