<?php $this->load->view('header'); ?>

<?php 

	if( $navbar != null )
	{
		$this->load->view($navbar);
	}

?>

<?php 

	if( $sidebar != null )
	{
		$this->load->view($sidebar);
	}

?>

<?php 

	if( $content != null )
	{
		$this->load->view($content);
	}
	else
	{
		echo "No content available";
	}

?>

<?php 	$this->load->view('scripts');?>

<?php 
	
	if( $footer != null ) 
	{
		$this->load->view('footer');
	
	}
	
	
?>


