<?php echo '
<script type="text/javascript" src="https://www.google.com/jsapi?.js"></script>
  <script type="text/javascript">
  function drawChart() {
    // Create the data table.
    var data = new google.visualization.DataTable();
   
	data.addColumn(\'string\', \'Priority\');
data.addColumn(\'number\', \'Allocated Hours\');
data.addRows([
        '; ?>

        <?php $_from = $this->_tpl_vars['DataGrid']['Rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['RowsGrid'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['RowsGrid']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['Row']):
        $this->_foreach['RowsGrid']['iteration']++;
?>
            ['<?php echo $this->_tpl_vars['Row']['DataCells']['priority']['Data']; ?>
', <?php echo $this->_tpl_vars['Row']['DataCells']['total_allocated_hrs']['Data']; ?>
],
        <?php endforeach; endif; unset($_from); ?>
        <?php echo '
        ]);

       var options = {
            title: \'\',is3D:true,
	    hAxis: {title: \'Total Allocated Hours\'}
        };
    // Instantiate and draw our chart, passing in some options.
    var chart1 = new google.visualization.PieChart(document.getElementById(\'chart_div_1\'));
   
    
   
    
    chart1.draw(data, options);
   
}
google.load(\'visualization\', \'1\', {packages:[\'corechart\'], callback: drawChart});
  
  </script>
'; ?>




<div id="chart_div_1"></div>


</div>
<?php  
$page->SetShowUserAuthBar(false);
 ?>