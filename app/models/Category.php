<?php
use Phalcon\Db\Column;
class Category extends \Phalcon\Mvc\Model
{
	public $id;    
	
	public function initialize()
    {
        $this->setSource("categories");
    }
	
	public function getCatId()
    {
        return $this->cat_id;
    }
	
	public function getCategoryCollection($cat_id = -1,$level = -1){
		$catCollection = Category::find();
		$html = '<ul class="nav">';
		foreach($catCollection as $cat){
			if($level == 1){
				$html .= '<li>';
				$html .= '<a href="#">';
				$html .= $cat->name;
				$html .= '</a>';
				$html .= '</li>';
			}
		}
		$html .= '</ul>';
		return $html;
	}
	
	public function validateData($data){
		if($data['parent_id'] == "None"){
			$level = 0;
		}
		else{
			$category =  Category::findFirstByCatId($data['parent_id']);
			$level = $category->level + 1;
		}
		return $level;
	}
	
	public function getUrl($id){
		return $this->url->get("admin/category/edit/$id");
		//$url = $this->url->get("admin/category/edit/$catId");
	}
	
	public function OrganizeCategoryCollection(){
		$collection = Category::find('level = 0');
		if(count($collection) > 0){
			$html = "<ul>";
			foreach($collection as $level0){
				$html .= '<li><a href="'.self::getUrl($level0->cat_id).'">'.$level0->name.'</a>';
				$sbCol1 = $level0::findByParentId($level0->cat_id);
				if(count($sbCol1) > 0){
					$html .="<ul>";
					foreach($sbCol1 as $level1){
						$html .= '<li><a href="'.self::getUrl($level1->cat_id).'">'.$level1->name.'</a>';
						$sbCol2 = $level1::findByParentId($level1->cat_id);
						if(count($sbCol2) > 0){
							$html .= "<ul>";
							foreach($sbCol2 as $level2){
								$html .= '<li><a href="'.self::getUrl($level2->cat_id).'">'. $level2->name.'</a>';
								$sbCol3 = $level2::findByParentId($level2->cat_id);
								if(count($sbCol3) > 0){
									$html .= "<ul>";
									foreach($sbCol3 as $level3){
										$html .='<li><a href="'.self::getUrl($level3->cat_id).'">'.$level3->name.'</a>';
										$sbCol4 = $level3::findByParentId($level3->cat_id);
										if(count($sbCol4) > 0){
											$html .= "<ul>";
											foreach($sbCol4 as $level4){
												$html .= '<li><a href="'.self::getUrl($level4->cat_id).'">'.$level4->name.'</a>';
												$sbCol5 = $level4::findByParentId($level4->cat_id);
												if(count($sbCol5) > 0){
													$html .= "<ul>";
													foreach($sbCol5 as $level5){
														$html .= '<li><a href="'.self::getUrl($level5->cat_id).'">'.$level5->name.'</a>';
														$sbCol6 = $level4::findByParentId($level5->cat_id);
														if(count($sbCol6) > 0){
															$html .= "<ul>";
															foreach($sbCol6 as $level6){
																$html .= '<li><a href="'.self::getUrl($level6->cat_id).'">'.$level6->name.'</a></li>';
															}
															$html .= "</ul>";
														}
														$html .= "</li>";
													}
													$html .= "</ul>";
												}
												$html .= "</li>";
											}
											$html .= "</ul>";
										}
										$html .= "</li>";
									}
									$html .="</ul>";
								}
								$html .="</li>";
							}
							$html .="</ul>";
						}
						$html .="</li>";
					}
					$html .="</ul>";
				}
				$html .="</li>";
			}
			$html .= "</ul>";
		}
		else{
			$html = "No Categories Found, Add Root Category";
		}
		return $html;
	}
	
	public function getCategoryList($id = -1,$parent_id = -1){
		$collection = Category::find('level = 0');
		$option = '<option>None</option>';
		$selected = "";
		if(count($collection) > 0){
			foreach($collection as $level0){
				if($level0->cat_id == $parent_id){
					$selected = "selected";
				}
				$option .= '<option value="'.$level0->cat_id.'" '.$selected.'>'.$level0->name.'</option>';
				$sbCol1 = $level0::findByParentId($level0->cat_id);
				if(count($sbCol1) > 0){
					foreach($sbCol1 as $level1){
						$selected = "";
						if($level1->cat_id == $parent_id){
							$selected = "selected";
						}
						$option .= '<option value="'.$level1->cat_id.'" '.$selected.'>-'.$level1->name.'</option>';
						$sbCol2 = $level1::findByParentId($level1->cat_id);
						if(count($sbCol2) > 0){
							foreach($sbCol2 as $level2){
								$selected = "";
								if($level2->cat_id == $parent_id){
									$selected = "selected";
								}
								$option .= '<option value="'.$level2->cat_id.'" '.$selected.'>--'.$level2->name.'</option>';
								$sbCol3 = $level2::findByParentId($level2->cat_id);
								if(count($sbCol3) > 0){
									foreach($sbCol3 as $level3){
										$selected = "";
										if($level3->cat_id == $parent_id){
											$selected = "selected";
										}
										$option .= '<option value="'.$level3->cat_id.'" '.$selected.'>---'.$level3->name.'</option>';
										$sbCol4 = $level3::findByParentId($level3->cat_id);
										if(count($sbCol4) > 0){
											foreach($sbCol4 as $level4){
												$selected = "";
												if($level4->cat_id == $parent_id){
													$selected = "selected";
												}
												$option .= '<option value="'.$level4->cat_id.'" '.$selected.'>----'.$level4->name.'</option>';
												$sbCol5 = $level4::findByParentId($level4->cat_id);
												if(count($sbCol5) > 0){
													foreach($sbCol5 as $level5){
														$selected = "";
														if($level5->cat_id == $parent_id){
															$selected = "selected";
														}
														$option .= '<option value="'.$level5->cat_id.'" '.$selected.'>-----'.$level5->name.'</option>';
														$sbCol6 = $level5::findByParentId($level5->cat_id);
														if(count($sbCol6) > 0){
															foreach($sbCol6 as $level6){
																$selected = "";
																if($level6->cat_id == $parent_id){
																	$selected = "selected";
																}
																$option .= '<option value="'.$level6->cat_id.'" '.$selected.'>------'.$level6->name.'</option>';
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		return $option;
	}
}