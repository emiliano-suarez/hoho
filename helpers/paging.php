<?php

namespace hoho\helpers;

class Helpers_Paging {
  protected $page;
  protected $pageSize;
  protected $totalResults;
  protected $totalPages;
  protected $urlModel;
  
  public function __construct($page, $pageSize, $urlModel) {
    $this->page = $page;
    $this->pageSize = $pageSize;
    $this->urlModel = $urlModel;
  }
  
  public function setTotalResults($resultsCount) {
    $this->totalResults = $resultsCount;
    $this->totalPages = (int) ceil($resultsCount/$this->pageSize);
  }
  
  public function mustShow() {
    return ($this->totalPages > 1);
  }
  
  public function getPageLink($pageNum) {
    if ($pageNum != $this->page) {
      return sprintf($this->urlModel, $pageNum);
    } else {
      return '#';
    }
  }
  
  public function getNextPageLink() {
    if ($this->page < $this->totalPages) {
      return $this->getPageLink($this->page + 1);
    } else {
      return '#';
    }
  }
  
  public function getPrevPageLink() {
    if ($this->page > 1) {
      return $this->getPageLink($this->page - 1);
    } else {
      return '#';
    }
  }

  public function __get($key) {
    return $this->$key;
  }
}