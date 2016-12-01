<?php echo '
<script type="text/javascript" src="https://www.google.com/jsapi?autoload={\'modules\':[{\'name\':\'visualization\',
       \'version\':\'1\',\'packages\':[\'timeline\']}]}"></script>
<script type="text/javascript">
google.setOnLoadCallback(drawChart);

function drawChart() {

  var container = document.getElementById(\'time_line\');

  var chart = new google.visualization.Timeline(container);

  var dataTable = new google.visualization.DataTable();

  dataTable.addColumn({ type: \'string\', id: \'Project\' });
  dataTable.addColumn({ type: \'date\', id: \'Start\' });
  dataTable.addColumn({ type: \'date\', id: \'End\' });

  dataTable.addRows([
        '; ?>

        <?php $_from = $this->_tpl_vars['DataGrid']['Rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['RowsGrid'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['RowsGrid']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['Row']):
        $this->_foreach['RowsGrid']['iteration']++;
?>
            ['<?php echo $this->_tpl_vars['Row']['DataCells']['project_name']['Data']; ?>
',  new Date(<?php echo $this->_tpl_vars['Row']['DataCells']['date_start']['Data']; ?>
),  new Date(<?php echo $this->_tpl_vars['Row']['DataCells']['date_end']['Data']; ?>
)],
        <?php endforeach; endif; unset($_from); ?>
        <?php echo '
        ]);
	
	
	
	

  chart.draw(dataTable);
}
</script>
'; ?>

<div id="time_line" style="width: 800px; height: 480px;"></div>
<?php  
$page->SetShowUserAuthBar(false);
 ?>
