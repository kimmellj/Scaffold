<?php
class AppController extends Controller
{
	/**
	 * Set the controller $paginate attribute by merging it with
     * any predefined $paginate settings.
	 *
	 * @param array $paginate Pagination settings as you would pass them to $this->paginate()
	 */
	public function setPaginate($paginate)
    {
        $this->paginate = Set::merge($this->paginate, $paginate);
	}
}