<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escapeurl', 'list/detail_page_edit.tpl', 12, false),)), $this); ?>
<?php ob_start(); ?>
    <div class="page-header">
        <h1>
            <?php echo $this->_tpl_vars['Page']->GetCaption(); ?>

        </h1>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "export-button.tpl", 'smarty_include_vars' => array('Items' => $this->_tpl_vars['Page']->GetExportButtonsViewData())));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "page_description_block.tpl", 'smarty_include_vars' => array('Description' => $this->_tpl_vars['Page']->GetGridHeader())));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h5><?php echo $this->_tpl_vars['Captions']->GetMessageString('MasterRecord'); ?>

    (<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['Page']->GetParentPageLink())) ? $this->_run_mod_handler('escapeurl', true, $_tmp) : smarty_modifier_escapeurl($_tmp)); ?>
"><?php echo $this->_tpl_vars['Captions']->GetMessageString('ReturnFromDetailToMaster'); ?>
</a>)
</h5>

<?php echo $this->_tpl_vars['MasterGrid']; ?>

<br />

    <?php if (count ( $this->_tpl_vars['SiblingDetails'] ) > 1): ?>
        <ul class="nav nav-tabs">
            <?php $_from = $this->_tpl_vars['SiblingDetails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['SiblingDetailsSection'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['SiblingDetailsSection']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['SiblingDetail']):
        $this->_foreach['SiblingDetailsSection']['iteration']++;
?>
                <li class="<?php if ($this->_tpl_vars['DetailPageName'] == $this->_tpl_vars['SiblingDetail']['Name']): ?>active<?php endif; ?>">
                    <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['SiblingDetail']['Link'])) ? $this->_run_mod_handler('escapeurl', true, $_tmp) : smarty_modifier_escapeurl($_tmp)); ?>
">
                        <?php echo $this->_tpl_vars['SiblingDetail']['Caption']; ?>

                    </a>
                </li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    <?php endif; ?>


    <?php echo $this->_tpl_vars['PageNavigator']; ?>


    <?php echo $this->_tpl_vars['Grid']; ?>


    <?php echo $this->_tpl_vars['PageNavigator2']; ?>

<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('ContentBlock', ob_get_contents());ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/list_page_template.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>