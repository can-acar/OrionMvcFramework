<?php
namespace OrionMvc;

interface IHttpContext
{
	/**
	 * This is function Init
	 *
	 * @param HttpRequest $request This is a description
	 * @param HttpResponse $response This is a description
	 * @return mixed This is the return value description
	 *
	 */
    public function Init(HttpRequest $request,HttpResponse $response);
}

