<?php

namespace OrionMvc;

interface IRouterCollection
{

	public function Add($Key,$Value);

	public function GetController($Default);

}