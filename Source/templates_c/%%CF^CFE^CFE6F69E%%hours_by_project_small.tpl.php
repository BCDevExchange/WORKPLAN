<?php echo '
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    
	function drawChart() {
        var data = google.visualization.arrayToDataTable([
            [\'Project\', \'Hours\']
        '; ?>

        <?php $_from = $this->_tpl_vars['DataGrid']['Rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['RowsGrid'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['RowsGrid']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['Row']):
        $this->_foreach['RowsGrid']['iteration']++;
?>
            ,['<?php echo $this->_tpl_vars['Row']['DataCells']['project_name']['Data']; ?>
', <?php echo $this->_tpl_vars['Row']['DataCells']['total_hours']['Data']; ?>
]
        <?php endforeach; endif; unset($_from); ?>
        <?php echo '
        ]);
		
		

        var options = {
            title: \'\',is3D:true
        };

		
		
		var formatter = new google.visualization.NumberFormat(
	{negativeColor: \'red\', negativeParens: true});
	formatter.format(data,1);
   
		
        var chart = new google.visualization.PieChart(document.getElementById(\'chart_div\'));
        chart.draw(data, options);
		
    }
</script>
'; ?>

<p>

<div id="chart_div"></div>


<?php  
$page->SetShowUserAuthBar(false);
 ?>
