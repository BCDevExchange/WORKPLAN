<?php echo '
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    
	
	
	function drawChart() {
        var data = new google.visualization.arrayToDataTable([
            [\'Project\', \'Approved Budget\']
        '; ?>

        <?php $_from = $this->_tpl_vars['DataGrid']['Rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['RowsGrid'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['RowsGrid']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['Row']):
        $this->_foreach['RowsGrid']['iteration']++;
?>
            ,['<?php echo $this->_tpl_vars['Row']['DataCells']['project_name']['Data']; ?>
', <?php echo $this->_tpl_vars['Row']['DataCells']['approved_budget']['Data']; ?>
]
        <?php endforeach; endif; unset($_from); ?>
        <?php echo '
        ]);
		var formatter = new google.visualization.NumberFormat(
      {prefix: \'$\', negativeColor: \'red\', negativeParens: true});
		formatter.format(data, 1);  

        var options = {
            pieSliceText: \'value\',
        legend: {
            position: \'labeled\'
        },
        chartArea: {
            height: \'100%\',
            width: \'90%\'
        },
        pieStartAngle: 90
        };
	
      var chart = new google.visualization.PieChart(document.getElementById(\'chart_div\'));
    chart.draw(data, options);
	 
    }
</script>
'; ?>



<div id="chart_div"></div>
<?php  
$page->SetShowUserAuthBar(false);
 ?>