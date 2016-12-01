<input
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "editors/editor_options.tpl", 'smarty_include_vars' => array('Editor' => $this->_tpl_vars['SpinEdit'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    type="number"
    value="<?php echo $this->_tpl_vars['SpinEdit']->GetValue(); ?>
"
    <?php if ($this->_tpl_vars['SpinEdit']->GetUseConstraints()): ?>
        min="<?php echo $this->_tpl_vars['SpinEdit']->GetMinValue(); ?>
"
        max="<?php echo $this->_tpl_vars['SpinEdit']->GetMaxValue(); ?>
"
    <?php endif; ?>
    <?php if ($this->_tpl_vars['SpinEdit']->GetStep() != 1): ?>
        step="<?php echo $this->_tpl_vars['SpinEdit']->GetStep(); ?>
"
    <?php endif; ?>
>