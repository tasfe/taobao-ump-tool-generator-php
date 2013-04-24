<?php
class Ump2ToolBuilder {
	private $name;
	private $actions;
	/**
	 * @var MarketingBuilder
	 */
	private $builder;
	private $description;
	private $toolcode;
	private $type;
	private $marketingTool;
	private $orderType;
	private $privilege;

	
	/**
	 * 
	 * @param string $type one of "ORDER"  "SUB_ORDER"|| ie，MarketingTool::TOOL_TYPE_ORDER,MarketingTool::TOOL_TYPE_SUB_ORDER
	 * @param unknown $actions 
	 */
	public function __construct($type,$actions){
		$this->builder=new MarketingBuilder();
		$this->actions=$actions;
		$this->type=$type;
		$this->checkType();
		$this->autoGenerate();
	}
	
	protected function autoGenerate(){
		$this->name="Ump优惠，大优惠";
		$this->toolcode='yourtoolcode'.uniqid();
		$this->description="项目测试描述";
		$this->orderType=MarketingTool::ORDER_TYPE_UNORDERABLE;
		$this->privilege=MarketingTool::PRIVILEGE_TYPE_PRIVATE;
	}
	
	
	/**
	 * @return MarketingTool
	 */
	public function build(){
		if ($this->marketingTool===null){
			$this->marketingTool=$this->buildTool();	
		}
		return $this->marketingTool;
	}
	
	/**
	 * @return String json to upload
	 */
	public function buildJson(){
		$this->build();
		return $this->builder->buildTool($this->marketingTool);
	}
	
	private function buildTool(){
		$tool = new MarketingTool();
		$tool->setName($this->name);
		$tool->setDescription($this->description);
		$tool->setToolCode($this->toolcode);
		$tool->setType($this->type);
		$tool->setOrderType($this->orderType);
		$tool->setPrivilege($this->privilege);
		$metaDataBuilder=new MetaDataBuilder($this->actions,$this->builder);
		$tool->setOperationMeta($metaDataBuilder->createMetaData());
		return $tool;
	}
	
	private function checkType(){
		if (!in_array($this->type,array(MarketingTool::TOOL_TYPE_ORDER,MarketingTool::TOOL_TYPE_SUB_ORDER))){
			throw new UmpException('type is not allowed(ORDER or SUB_ORDER)');//to continue
		}
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function getDescription() {
		return $this->description;
	}

	public function getToolcode() {
		return $this->toolcode;
	}

	public function getOrderType() {
		return $this->orderType;
	}

	public function getPrivilege() {
		return $this->privilege;
	}

	public function setDescription($description) {
		$this->description = $description;
	}
	
	public function setToolcode($toolcode) {
		$this->toolcode = $toolcode;
	}
	
	public function setType($type) {
		$this->type = $type;
	}
	
	public function setOrderType($orderType) {
		$this->orderType = $orderType;
	}

	public function setPrivilege($privilege) {
		$this->privilege = $privilege;
	}

}

?>