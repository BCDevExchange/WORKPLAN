<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=8, IE=9, IE=10">
    <title><?php echo $this->_tpl_vars['Captions']->GetMessageString('AdministrationPanel'); ?>
</title>

    <link rel="stylesheet/less" type="text/css" href="components/css/admin_panel.less" />
    <link rel="stylesheet" type="text/css" href="components/css/main.css" />
    <link rel="stylesheet" type="text/css" href="components/css/user.css" />

    <script src="components/js/jquery/jquery.min.js"></script>
    <script src="components/js/libs/mootools-core.js"></script>
    <script src="components/js/libs/async.js"></script>
    <script src="components/js/libs/underscore.js"></script>
    <script src="components/js/bootstrap/bootstrap.js"></script>
    <script src="components/js/libs/bootbox.min.js"></script>
    <script src="components/js/libs/less.js"></script>

    <script src="components/js/jquery/jquery.tmpl.js"></script>
    <script src="components/js/libs/knockout.js"></script>
    <script src="components/js/jquery/jquery.tools.history.js"></script>

    <script type="text/javascript" src="components/js/require-config.js"></script>
    <script type="text/javascript" src="components/js/require.js"></script>
    <script type="text/javascript" src="components/js/user.js"></script>

    <script type="text/javascript">
        <?php echo '
        PhpGenAdmin = {};
        PhpGenAdmin.CurrentUsers = '; ?>
<?php echo $this->_tpl_vars['Users']; ?>
<?php echo ';
        '; ?>

    </script>
    <script type="text/javascript" src="components/js/pg.user_management_api.js"></script>
    <script type="text/javascript" src="components/js/pgui.change_password_dialog.js"></script>
    <script type="text/javascript" src="components/js/pgui.password_dialog_utils.js"></script>
    <script type="text/javascript" src="components/js/pgui.admin_panel.js"></script>
</head>
<body>

<div id="pg-admin-create-user-dialog" class="modal hide">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
        <h3><?php echo $this->_tpl_vars['Captions']->GetMessageString('CreateUser'); ?>
</h3>
    </div>

    <div class="modal-body">
        <form class="form-horizontal">

            <div class="control-group">
                <label class="control-label" for="newuser-id">Id</label>
                <div class="controls">
                    <input type="text" id="newuser-id" name="id" data-bind="value: newUser.id" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="newuser-username"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Name'); ?>
</label>
                <div class="controls">
                    <input type="text" id="newuser-username" name="name" data-bind="value: newUser.name" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="newuser-password"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Password'); ?>
</label>
                <div class="controls">
                    <input type="password" id="newuser-password" name="password" data-bind="value: newUser.password" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="newuser-confirmed-password"><?php echo $this->_tpl_vars['Captions']->GetMessageString('ConfirmPassword'); ?>
</label>
                <div class="controls">
                    <input type="password" id="newuser-confirmed-password" name="confirmedPassword" data-bind="value: newUser.confirmedPassword" />
                </div>
            </div>

            <div class="control-group">
                <div class="alert alert-error" id="newuser-confirmed-password-error">
                    <p><?php echo $this->_tpl_vars['Captions']->GetMessageString('ConfirmedPasswordError'); ?>
</p>
                </div>
            </div>

        </form>
    </div>

    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal" id="close-create-user-dialog"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Close'); ?>
</a>
        <a href="#" class="btn btn-primary" id="save-create-user-dialog"><?php echo $this->_tpl_vars['Captions']->GetMessageString('CreateUser'); ?>
</a>
    </div>

</div>

<div id="pg-admin-edit-user-dialog" class="modal hide">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3><?php echo $this->_tpl_vars['Captions']->GetMessageString('RenameUser'); ?>
</h3>
    </div>

    <div class="modal-body">
        <form class="form-horizontal">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="user-id">Id</label>
                    <div class="controls">
                        <input class="disabled" disabled="" id="user-id" type="text" name="id" data-bind="value: editUser.id" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="user-username"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Name'); ?>
</label>
                    <div class="controls">
                        <input id="user-username" type="text" name="id" data-bind="value: editUser.name" />
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal" id="close-edit-user-dialog"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Close'); ?>
</a>
        <a href="#" class="btn btn-primary" id="save-edit-user-dialog"><?php echo $this->_tpl_vars['Captions']->GetMessageString('SaveChanges'); ?>
</a>
    </div>
</div>

<div class="navbar" id="navbar">
    <div class="navbar-inner">
        <div class="container">
            <div class="pull-left"><p><?php echo $this->_tpl_vars['Page']->GetHeader(); ?>
</p></div>

        <?php if ($this->_tpl_vars['Authentication']['Enabled']): ?>
            <ul class="nav pull-right">
                <li class="active">
                    <a href="#" onclick="return false;" style="cursor: default;">
                        <i class="pg-icon-user"></i>
                        <?php echo $this->_tpl_vars['Authentication']['CurrentUser']['Name']; ?>
</a>
                </li>
                <?php if ($this->_tpl_vars['Authentication']['LoggedIn']): ?>
                    <li><a href="login.php?operation=logout"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Logout'); ?>
</a></li>
                    <?php else: ?>
                    <li><a href="login.php"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Login'); ?>
</a></li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3" id="side-bar">

            <div class="sidebar-nav-fixed">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "page_list.tpl", 'smarty_include_vars' => array('List' => $this->_tpl_vars['PageList'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>

            <script><?php echo '
            $(\'.sidebar-nav-fixed\').css(\'top\',
                    Math.max(0, $(\'#navbar\').outerHeight() - $(window).scrollTop())
            );
            $(\'#navbar img\').load(function() {
                $(\'.sidebar-nav-fixed\').css(\'top\',
                        Math.max(0, $(\'#navbar\').outerHeight() - $(window).scrollTop())
                );
            });
            $(window).scroll(function() {
                $(\'.sidebar-nav-fixed\').css(\'top\',
                        Math.max(0, $(\'#navbar\').outerHeight() - $(window).scrollTop())
                );
            });
            '; ?>
</script>

        </div>

        <div class="span9">
            <div class="page-header">
                <h1><?php echo $this->_tpl_vars['Captions']->GetMessageString('AdministrationPanel'); ?>
</h1>
            </div>

            <table class="pgui-grid users-grid">

                <thead>
                <tr>
                    <td colspan="3" class="header-panel">
                        <div class="btn-toolbar">
                            <div class="btn-group">
                                <button class="btn add-user" data-bind="click: invokeAddUserDialog">
                                    <i class="pg-icon-user-add"></i>
                                <?php echo $this->_tpl_vars['Captions']->GetMessageString('AddUser'); ?>

                                </button>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="header">
                    <th colspan="2"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Actions'); ?>
</th>
                    <th><?php echo $this->_tpl_vars['Captions']->GetMessageString('Username'); ?>
</th>
                </tr>
                </thead>

            <?php echo '
                <tbody data-bind="template: { name: \'usersRowTemplate\', foreach: usersOnCurrentPage }">
                <script type="text/html" id="usersRowTemplate">

                    <tr class="pg-row users-row">
                        <td class="show-user-grants">
                            <div class="show-user-grants"
                                 data-bind="css: { expanded: grantsExpanded() == true }">
                                <button class="btn show-user-grants" title="Show user grants"
                                        data-bind="click: toggleGrantsExpanded, css: { expanded: grantsExpanded() == true }">
                                    <i class="pg-icon-permissions-edit"></i>
                                    '; ?>
<?php echo $this->_tpl_vars['Captions']->GetMessageString('Permissions'); ?>
<?php echo '
                                </button>
                            </div>
                        </td>

                        <td class="actions">
                            <button
                                    class="btn edit-user"
                                    title="Rename user"
                                    data-bind="click: function() { PhpGenAdmin.adminPanelViewModel.invokeEditUserDialog($data); }, visible: editable">
                                <i class="pg-icon-user-edit"></i>
                                '; ?>
<?php echo $this->_tpl_vars['Captions']->GetMessageString('Rename'); ?>
<?php echo '
                            </button>

                            <button
                                    class="btn change-user-password"
                                    title="Change user password"
                                    data-bind="click: function() { PhpGenAdmin.adminPanelViewModel.invokeChangeUserPasswordDialog($data); }, visible: editable">
                                <i class="pg-icon-password-change"></i>
                                '; ?>
<?php echo $this->_tpl_vars['Captions']->GetMessageString('ChangePassword'); ?>
<?php echo '
                            </button>

                            <button
                                    class="btn delete-user"
                                    title="Delete user"
                                    data-bind="click: function() { PhpGenAdmin.adminPanelViewModel.invokeRemoveUserDialog($data); }, visible: editable">
                                <i class="pg-icon-user-delete"></i>
                                '; ?>
<?php echo $this->_tpl_vars['Captions']->GetMessageString('Delete'); ?>
<?php echo '
                            </button>

                        </td>

                        <td class="user-name"><span data-bind="text: name"></span></td>
                    </tr>

                    <tr class="grants-row">
                        <td class="grants-row" colspan="3" data-bind="visible: grantsExpanded">
                            <div class="grants-container">
                                <div class="loading-panel" data-bind="visible: !grantsLoaded()">
                                    <div>'; ?>
<?php echo $this->_tpl_vars['Captions']->GetMessageString('LoadingDots'); ?>
<?php echo '</div>
                                </div>
                                <table class="user-grant-list pgui-grid" data-bind="visible: grantsLoaded()">
                                    <thead>
                                    <tr class="header">
                                        <th>'; ?>
<?php echo $this->_tpl_vars['Captions']->GetMessageString('PageName'); ?>
<?php echo '</th>
                                        <th>'; ?>
<?php echo $this->_tpl_vars['Captions']->GetMessageString('Admin'); ?>
<?php echo '</th>
                                        <th>'; ?>
<?php echo $this->_tpl_vars['Captions']->GetMessageString('Select'); ?>
<?php echo '</th>
                                        <th>'; ?>
<?php echo $this->_tpl_vars['Captions']->GetMessageString('Update'); ?>
<?php echo '</th>
                                        <th>'; ?>
<?php echo $this->_tpl_vars['Captions']->GetMessageString('Insert'); ?>
<?php echo '</th>
                                        <th>'; ?>
<?php echo $this->_tpl_vars['Captions']->GetMessageString('Delete'); ?>
<?php echo '</th>
                                    </tr>
                                    </thead>
                                    <tbody data-bind="template: { name: \'userGrantsTemplate\', foreach: grants }"></tbody>
                                </table>
                            </div>
                        </td>
                    </tr>

                </script>

                <script type="text/html" id="userGrantsTemplate">
                    <tr>
                        <td class="page-caption"><span data-bind="text: caption"></span></td>
                        <td class="page-grant"><input type="checkbox" data-bind="checked: adminGrant" /></td>
                        <td class="page-grant"><input type="checkbox" data-bind="checked: selectGrant" /></td>
                        <td class="page-grant"><input type="checkbox" data-bind="checked: updateGrant" /></td>
                        <td class="page-grant"><input type="checkbox" data-bind="checked: insertGrant" /></td>
                        <td class="page-grant"><input type="checkbox" data-bind="checked: deleteGrant" /></td>
                    </tr>
                </script>
                </tbody>
            '; ?>

            </table>


            <hr>
            <footer><p><?php echo $this->_tpl_vars['Page']->GetFooter(); ?>
</p></footer>
        </div>
    </div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'common/change_password_dialog.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>