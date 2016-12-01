<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */


    include_once dirname(__FILE__) . '/' . 'components/utils/check_utils.php';
    CheckPHPVersion();
    CheckTemplatesCacheFolderIsExistsAndWritable();


    include_once dirname(__FILE__) . '/' . 'phpgen_settings.php';
    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthorizationStrategy()->ApplyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    // OnBeforePageExecute event handler
    
    
    
    class timesheetDetailView0taskDetailView0projectPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyConnectionFactory(),
                GetConnectionOptions(),
                '`timesheet`');
            $field = new IntegerField('timesheet_id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('name');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('task_id');
            $this->dataset->AddField($field, false);
            $field = new StringField('hours');
            $this->dataset->AddField($field, false);
            $field = new StringField('notes');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('time_type');
            $this->dataset->AddField($field, false);
            $field = new DateField('date');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('staff_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(false);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('timesheetDetailViewGrid0taskDetailView0project_name_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for hours field
            //
            $column = new TextViewColumn('hours', 'Hours', $this->dataset);
            $grid->SetTotal($column, PredefinedAggregate::$Sum);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(false);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('timesheetDetailViewGrid0taskDetailView0project_notes_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function timesheetDetailViewGrid0taskDetailView0project_OnCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles)
        {
        $rowStyles = 'background-color: #F3E2A9';
        }
        function timesheetDetailViewGrid0taskDetailView0project_OnCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
            if ($columnName == 'hours')
            
            {
            
                $customText = '<strong>Total: ' . $totalValue . '</strong>';
            
                $handled = true;   
            
            }
        }
        function timesheetDetailViewGrid0taskDetailView0project_BeforeInsertRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            $userID = $this->GetEnvVar('CURRENT_USER_ID');
            $rowData['staff_id'] = $userID;
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'timesheetDetailViewGrid0taskDetailView0project');
            $result->SetAllowDeleteSelected(false);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $result->OnCustomDrawCell->AddListener('timesheetDetailViewGrid0taskDetailView0project' . '_OnCustomDrawRow', $this);
            $result->OnCustomRenderTotal->AddListener('timesheetDetailViewGrid0taskDetailView0project' . '_' . 'OnCustomRenderTotal', $this);
            $result->BeforeInsertRecord->AddListener('timesheetDetailViewGrid0taskDetailView0project' . '_' . 'BeforeInsertRecord', $this);
            $this->AddFieldColumns($result);
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(false);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'timesheetDetailViewGrid0taskDetailView0project_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(false);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'timesheetDetailViewGrid0taskDetailView0project_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
    }
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class timesheetDetailEdit0taskDetailView0projectPage extends DetailPageEdit
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyConnectionFactory(),
                GetConnectionOptions(),
                '`timesheet`');
            $field = new IntegerField('timesheet_id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('name');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('task_id');
            $this->dataset->AddField($field, false);
            $field = new StringField('hours');
            $this->dataset->AddField($field, false);
            $field = new StringField('notes');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('time_type');
            $this->dataset->AddField($field, false);
            $field = new DateField('date');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('staff_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        public function GetPageList()
        {
            return null;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl(Grid $grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('timesheetDetailEdit0taskDetailView0projectssearch', $this->dataset,
                array('name', 'task_id', 'hours', 'notes', 'date'),
                array($this->RenderText('Name'), $this->RenderText('Task'), $this->RenderText('Hours'), $this->RenderText('Notes'), $this->RenderText('Date')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl(Grid $grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('timesheetDetailEdit0taskDetailView0projectasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('name', $this->RenderText('Name')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('task_id', $this->RenderText('Task')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('hours', $this->RenderText('Hours')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('notes', $this->RenderText('Notes')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('date', $this->RenderText('Date'), 'Y-m-d'));
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/view_action.png');
            }
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/edit_action.png');
                $column->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/delete_action.png');
                $column->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $column->SetAdditionalAttribute('data-modal-delete', 'true');
                $column->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/copy_action.png');
            }
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('timesheetDetailEditGrid0taskDetailView0project_name_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for hours field
            //
            $column = new TextViewColumn('hours', 'Hours', $this->dataset);
            $grid->SetTotal($column, PredefinedAggregate::$Sum);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('timesheetDetailEditGrid0taskDetailView0project_notes_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('timesheetDetailEditGrid0taskDetailView0project_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for hours field
            //
            $column = new TextViewColumn('hours', 'Hours', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('timesheetDetailEditGrid0taskDetailView0project_notes_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for task_id field
            //
            $editor = new ComboBox('task_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Task', 'task_id', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->setEnabled(false);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for hours field
            //
            $editor = new SpinEdit('hours_edit');
            $editor->SetUseConstraints(true);
            $editor->SetMaxValue(12);
            $editor->SetMinValue(0);
            $editor->SetStep(1);
            $editColumn = new CustomEditColumn('Hours', 'hours', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for date field
            //
            $editor = new DateTimeEdit('date_edit', false, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date', 'date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetInsertDefaultValue($this->RenderText('%CURRENT_USER_NAME%'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for task_id field
            //
            $editor = new ComboBox('task_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Task', 'task_id', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->setEnabled(false);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for hours field
            //
            $editor = new SpinEdit('hours_edit');
            $editor->SetUseConstraints(true);
            $editor->SetMaxValue(12);
            $editor->SetMinValue(0);
            $editor->SetStep(1);
            $editColumn = new CustomEditColumn('Hours', 'hours', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue($this->RenderText('7'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for date field
            //
            $editor = new DateTimeEdit('date_edit', false, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date', 'date', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue($this->RenderText('%CURRENT_DATE%'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(true);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for hours field
            //
            $column = new TextViewColumn('hours', 'Hours', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for hours field
            //
            $column = new TextViewColumn('hours', 'Hours', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
        	$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function timesheetDetailEditGrid0taskDetailView0project_OnCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles)
        {
        $rowStyles = 'background-color: #F3E2A9';
        }
        function timesheetDetailEditGrid0taskDetailView0project_OnCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
            if ($columnName == 'hours')
            
            {
            
                $customText = '<strong>Total: ' . $totalValue . '</strong>';
            
                $handled = true;   
            
            }
        }
        function timesheetDetailEditGrid0taskDetailView0project_BeforeInsertRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            $userID = $this->GetEnvVar('CURRENT_USER_ID');
            $rowData['staff_id'] = $userID;
        }
        public function ShowEditButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasEditGrant($this->GetDataset());
        }
        public function ShowDeleteButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasDeleteGrant($this->GetDataset());
        }
        
        public function GetModalGridDeleteHandler() { return 'timesheetDetailEdit0taskDetailView0project_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'timesheetDetailEditGrid0taskDetailView0project');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
                $result->SetAllowDeleteSelected(true);
            else
                $result->SetAllowDeleteSelected(false);
            ApplyCommonPageSettings($this, $result);
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $result->OnCustomDrawCell->AddListener('timesheetDetailEditGrid0taskDetailView0project' . '_OnCustomDrawRow', $this);
            $result->OnCustomRenderTotal->AddListener('timesheetDetailEditGrid0taskDetailView0project' . '_' . 'OnCustomRenderTotal', $this);
            $result->BeforeInsertRecord->AddListener('timesheetDetailEditGrid0taskDetailView0project' . '_' . 'BeforeInsertRecord', $this);
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetHidePageListByDefault(false);
            $this->SetExportToExcelAvailable(true);
            $this->SetExportToWordAvailable(true);
            $this->SetExportToXmlAvailable(true);
            $this->SetExportToCsvAvailable(true);
            $this->SetExportToPdfAvailable(true);
            $this->SetPrinterFriendlyAvailable(true);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(true);
            $this->SetFilterRowAvailable(true);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
    
            //
            // Http Handlers
            //
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'timesheetDetailEditGrid0taskDetailView0project_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'timesheetDetailEditGrid0taskDetailView0project_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'timesheetDetailEditGrid0taskDetailView0project_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'timesheetDetailEditGrid0taskDetailView0project_notes_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
        
        public function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }    
    }
    
    // OnBeforePageExecute event handler
    
    
    
    class taskDetailView0projectPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyConnectionFactory(),
                GetConnectionOptions(),
                '`task`');
            $field = new IntegerField('task_id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('project_id');
            $this->dataset->AddField($field, false);
            $field = new StringField('assigned_to');
            $this->dataset->AddField($field, false);
            $field = new DateField('date_start');
            $this->dataset->AddField($field, false);
            $field = new DateField('date_end');
            $this->dataset->AddField($field, false);
            $field = new StringField('task_name');
            $this->dataset->AddField($field, false);
            $field = new StringField('notes');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('hrs');
            $this->dataset->AddField($field, false);
            $field = new StringField('wo');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('staff_id');
            $this->dataset->AddField($field, false);
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            if (GetCurrentUserGrantForDataSource('task.timesheet')->HasViewGrant())
            {
              //
            // View column for timesheetDetailView0taskDetailView0project detail
            //
            $column = new DetailColumn(array('task_id'), 'detail0taskDetailView0project', 'timesheetDetailEdit0taskDetailView0project_handler', 'timesheetDetailView0taskDetailView0project_handler', $this->dataset, 'Time Tracking for this Task', $this->RenderText('TimeTracking'));
              $grid->AddViewColumn($column);
            }
            
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Parent Project', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(false);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('taskDetailViewGrid0project_task_name_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(false);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('taskDetailViewGrid0project_notes_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for hrs field
            //
            $column = new TextViewColumn('hrs', 'Hrs', $this->dataset);
            $grid->SetTotal($column, PredefinedAggregate::$Sum);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
        
        function CreateMasterDetailRecordGridFortimesheetDetailEdit0taskDetailView0projectGrid()
        {
            $result = new Grid($this, $this->dataset, 'MasterDetailRecordGridFortimesheetDetailEdit0taskDetailView0project');
            $result->SetAllowDeleteSelected(false);
            $result->OnCustomDrawCell->AddListener('MasterDetailRecordGridFortimesheetDetailEdit0taskDetailView0project' . '_OnCustomDrawRow', $this);
            $result->SetShowFilterBuilder(false);
            $result->SetAdvancedSearchAvailable(false);
            $result->SetFilterRowAvailable(false);
            $result->SetShowUpdateLink(false);
            $result->SetEnabledInlineEditing(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetName('master_grid');
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Parent Project', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('taskGrid_task_name_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('taskGrid_notes_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for hrs field
            //
            $column = new TextViewColumn('hrs', 'Hrs', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Parent Project', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for hrs field
            //
            $column = new TextViewColumn('hrs', 'Hrs', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $result->AddPrintColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            return $result;
        }
        
        public function MasterDetailRecordGridFortimesheetDetailEdit0taskDetailView0project_OnCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles)
        {
        $rowStyles = 'background-color: #F6D8CE';
        }
        
        function BeforeBeginRenderPage()
        {
            if ($this->GetRecordPermission() != null)
        	       if (!$this->GetRecordPermission()->CanAllUsersViewRecords())
                     if (GetApplication()->GetCurrentUserId() == null)
                         $this->dataset->AddFieldFilter('staff_id', new IsNullFieldFilter());
                     else
        		             $this->dataset->AddFieldFilter('staff_id', new FieldFilter(GetApplication()->GetCurrentUserId(), '='));
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function taskDetailViewGrid0project_OnCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles)
        {
        $rowStyles = 'background-color: #F6D8CE';
        }
        function taskDetailViewGrid0project_BeforeUpdateRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            if (isProjectApproved($page->GetConnection())) {
              $cancel = true;
              $message = 'You cannot change a task that belongs to an approved project'; }
            
            else
            $rowData['staff_id'] = $rowData['assigned_to'];
        }
        function taskDetailViewGrid0project_BeforeDeleteRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            if (isProjectApproved($page->GetConnection())) {
              $cancel = true;
              $message = 'You cannot delete a task from an approved project'; }
        }
        function taskDetailViewGrid0project_BeforeInsertRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            if (isProjectApproved($page->GetConnection())) {
              $cancel = true;
              $message = 'You cannot add a task to an approved project.'; }
            else
            $rowData['staff_id'] = $rowData['assigned_to'];
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'taskDetailViewGrid0project');
            $result->SetAllowDeleteSelected(false);
            $result->SetInsertClientValidationScript($this->RenderText('if (fieldValues[\'project_id\'] ==\'\')
            
            {
            
                errorInfo.SetMessage(\'Only project lead may add tasks to this project.\'); 
            
                return false;
            
            }'));
            
            $result->SetInsertClientEditorValueChangedScript($this->RenderText('if (fieldValues[\'project_id\'] ==\'\')
            
            {
            
                errorInfo.SetMessage(\'Only project lead may add tasks to this project.\'); 
            
                return false;
            
            }'));
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(true);
            $result->SetWidth('');
            $result->OnCustomDrawCell->AddListener('taskDetailViewGrid0project' . '_OnCustomDrawRow', $this);
            $result->BeforeUpdateRecord->AddListener('taskDetailViewGrid0project' . '_' . 'BeforeUpdateRecord', $this);
            $result->BeforeDeleteRecord->AddListener('taskDetailViewGrid0project' . '_' . 'BeforeDeleteRecord', $this);
            $result->BeforeInsertRecord->AddListener('taskDetailViewGrid0project' . '_' . 'BeforeInsertRecord', $this);
            $this->AddFieldColumns($result);
            $pageView = new timesheetDetailView0taskDetailView0projectPage($this, 'TimeTracking', 'TimeTracking', array('task_id'), GetCurrentUserGrantForDataSource('task.timesheet'), 'UTF-8', 20, 'timesheetDetailEdit0taskDetailView0project_handler');
            
            $pageView->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('task.timesheet'));
            $handler = new PageHTTPHandler('timesheetDetailView0taskDetailView0project_handler', $pageView);
            GetApplication()->RegisterHTTPHandler($handler);
            $pageEdit = new timesheetDetailEdit0taskDetailView0projectPage($this, array('task_id'), array('task_id'), $this->GetForeingKeyFields(), $this->CreateMasterDetailRecordGridFortimesheetDetailEdit0taskDetailView0projectGrid(), $this->dataset, GetCurrentUserGrantForDataSource('task.timesheet'), 'UTF-8');
            
            $pageEdit->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('task.timesheet'));
            $pageEdit->SetShortCaption('Time Tracking for this Task');
            $pageEdit->SetHeader(GetPagesHeader());
            $pageEdit->SetFooter(GetPagesFooter());
            $pageEdit->SetCaption('TimeTracking');
            $pageEdit->SetHttpHandlerName('timesheetDetailEdit0taskDetailView0project_handler');
            $handler = new PageHTTPHandler('timesheetDetailEdit0taskDetailView0project_handler', $pageEdit);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(false);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'taskDetailViewGrid0project_task_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(false);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'taskDetailViewGrid0project_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
    }
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class timesheetDetailView0taskDetailEdit0projectPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyConnectionFactory(),
                GetConnectionOptions(),
                '`timesheet`');
            $field = new IntegerField('timesheet_id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('name');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('task_id');
            $this->dataset->AddField($field, false);
            $field = new StringField('hours');
            $this->dataset->AddField($field, false);
            $field = new StringField('notes');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('time_type');
            $this->dataset->AddField($field, false);
            $field = new DateField('date');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('staff_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(false);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('timesheetDetailViewGrid0taskDetailEdit0project_name_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for hours field
            //
            $column = new TextViewColumn('hours', 'Hours', $this->dataset);
            $grid->SetTotal($column, PredefinedAggregate::$Sum);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(false);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('timesheetDetailViewGrid0taskDetailEdit0project_notes_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function timesheetDetailViewGrid0taskDetailEdit0project_OnCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles)
        {
        $rowStyles = 'background-color: #F3E2A9';
        }
        function timesheetDetailViewGrid0taskDetailEdit0project_OnCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
            if ($columnName == 'hours')
            
            {
            
                $customText = '<strong>Total: ' . $totalValue . '</strong>';
            
                $handled = true;   
            
            }
        }
        function timesheetDetailViewGrid0taskDetailEdit0project_BeforeInsertRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            $userID = $this->GetEnvVar('CURRENT_USER_ID');
            $rowData['staff_id'] = $userID;
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'timesheetDetailViewGrid0taskDetailEdit0project');
            $result->SetAllowDeleteSelected(false);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $result->OnCustomDrawCell->AddListener('timesheetDetailViewGrid0taskDetailEdit0project' . '_OnCustomDrawRow', $this);
            $result->OnCustomRenderTotal->AddListener('timesheetDetailViewGrid0taskDetailEdit0project' . '_' . 'OnCustomRenderTotal', $this);
            $result->BeforeInsertRecord->AddListener('timesheetDetailViewGrid0taskDetailEdit0project' . '_' . 'BeforeInsertRecord', $this);
            $this->AddFieldColumns($result);
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(false);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'timesheetDetailViewGrid0taskDetailEdit0project_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(false);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'timesheetDetailViewGrid0taskDetailEdit0project_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
    }
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class timesheetDetailEdit0taskDetailEdit0projectPage extends DetailPageEdit
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyConnectionFactory(),
                GetConnectionOptions(),
                '`timesheet`');
            $field = new IntegerField('timesheet_id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('name');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('task_id');
            $this->dataset->AddField($field, false);
            $field = new StringField('hours');
            $this->dataset->AddField($field, false);
            $field = new StringField('notes');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('time_type');
            $this->dataset->AddField($field, false);
            $field = new DateField('date');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('staff_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        public function GetPageList()
        {
            return null;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl(Grid $grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('timesheetDetailEdit0taskDetailEdit0projectssearch', $this->dataset,
                array('name', 'task_id', 'hours', 'notes', 'date'),
                array($this->RenderText('Name'), $this->RenderText('Task'), $this->RenderText('Hours'), $this->RenderText('Notes'), $this->RenderText('Date')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl(Grid $grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('timesheetDetailEdit0taskDetailEdit0projectasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('name', $this->RenderText('Name')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('task_id', $this->RenderText('Task')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('hours', $this->RenderText('Hours')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('notes', $this->RenderText('Notes')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('date', $this->RenderText('Date'), 'Y-m-d'));
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/view_action.png');
            }
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/edit_action.png');
                $column->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/delete_action.png');
                $column->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $column->SetAdditionalAttribute('data-modal-delete', 'true');
                $column->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/copy_action.png');
            }
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('timesheetDetailEditGrid0taskDetailEdit0project_name_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for hours field
            //
            $column = new TextViewColumn('hours', 'Hours', $this->dataset);
            $grid->SetTotal($column, PredefinedAggregate::$Sum);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('timesheetDetailEditGrid0taskDetailEdit0project_notes_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('timesheetDetailEditGrid0taskDetailEdit0project_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for hours field
            //
            $column = new TextViewColumn('hours', 'Hours', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('timesheetDetailEditGrid0taskDetailEdit0project_notes_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for task_id field
            //
            $editor = new ComboBox('task_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Task', 'task_id', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->setEnabled(false);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for hours field
            //
            $editor = new SpinEdit('hours_edit');
            $editor->SetUseConstraints(true);
            $editor->SetMaxValue(12);
            $editor->SetMinValue(0);
            $editor->SetStep(1);
            $editColumn = new CustomEditColumn('Hours', 'hours', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for date field
            //
            $editor = new DateTimeEdit('date_edit', false, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date', 'date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetInsertDefaultValue($this->RenderText('%CURRENT_USER_NAME%'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for task_id field
            //
            $editor = new ComboBox('task_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Task', 'task_id', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->setEnabled(false);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for hours field
            //
            $editor = new SpinEdit('hours_edit');
            $editor->SetUseConstraints(true);
            $editor->SetMaxValue(12);
            $editor->SetMinValue(0);
            $editor->SetStep(1);
            $editColumn = new CustomEditColumn('Hours', 'hours', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue($this->RenderText('7'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for date field
            //
            $editor = new DateTimeEdit('date_edit', false, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date', 'date', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue($this->RenderText('%CURRENT_DATE%'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(true);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for hours field
            //
            $column = new TextViewColumn('hours', 'Hours', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for hours field
            //
            $column = new TextViewColumn('hours', 'Hours', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for date field
            //
            $column = new DateTimeViewColumn('date', 'Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
        	$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function timesheetDetailEditGrid0taskDetailEdit0project_OnCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles)
        {
        $rowStyles = 'background-color: #F3E2A9';
        }
        function timesheetDetailEditGrid0taskDetailEdit0project_OnCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
            if ($columnName == 'hours')
            
            {
            
                $customText = '<strong>Total: ' . $totalValue . '</strong>';
            
                $handled = true;   
            
            }
        }
        function timesheetDetailEditGrid0taskDetailEdit0project_BeforeInsertRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            $userID = $this->GetEnvVar('CURRENT_USER_ID');
            $rowData['staff_id'] = $userID;
        }
        public function ShowEditButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasEditGrant($this->GetDataset());
        }
        public function ShowDeleteButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasDeleteGrant($this->GetDataset());
        }
        
        public function GetModalGridDeleteHandler() { return 'timesheetDetailEdit0taskDetailEdit0project_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'timesheetDetailEditGrid0taskDetailEdit0project');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
                $result->SetAllowDeleteSelected(true);
            else
                $result->SetAllowDeleteSelected(false);
            ApplyCommonPageSettings($this, $result);
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $result->OnCustomDrawCell->AddListener('timesheetDetailEditGrid0taskDetailEdit0project' . '_OnCustomDrawRow', $this);
            $result->OnCustomRenderTotal->AddListener('timesheetDetailEditGrid0taskDetailEdit0project' . '_' . 'OnCustomRenderTotal', $this);
            $result->BeforeInsertRecord->AddListener('timesheetDetailEditGrid0taskDetailEdit0project' . '_' . 'BeforeInsertRecord', $this);
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetHidePageListByDefault(false);
            $this->SetExportToExcelAvailable(true);
            $this->SetExportToWordAvailable(true);
            $this->SetExportToXmlAvailable(true);
            $this->SetExportToCsvAvailable(true);
            $this->SetExportToPdfAvailable(true);
            $this->SetPrinterFriendlyAvailable(true);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(true);
            $this->SetFilterRowAvailable(true);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
    
            //
            // Http Handlers
            //
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'timesheetDetailEditGrid0taskDetailEdit0project_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'timesheetDetailEditGrid0taskDetailEdit0project_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for name field
            //
            $column = new TextViewColumn('name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'timesheetDetailEditGrid0taskDetailEdit0project_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'timesheetDetailEditGrid0taskDetailEdit0project_notes_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
        
        public function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }    
    }
    
    // OnBeforePageExecute event handler
    function isProjectApproved($connection) {
      $approved = 0;
      if (GetApplication()->IsGETValueSet('fk0')) {
        $sqlText = 'SELECT approved FROM project WHERE project_id = '. 
    GetApplication()->GetGETValue('fk0');
        $approved = $connection->ExecScalarSQL($sqlText);
      }
      return ($approved == 1);
    }
    
    
    class taskDetailEdit0projectPage extends DetailPageEdit
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyConnectionFactory(),
                GetConnectionOptions(),
                '`task`');
            $field = new IntegerField('task_id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('project_id');
            $this->dataset->AddField($field, false);
            $field = new StringField('assigned_to');
            $this->dataset->AddField($field, false);
            $field = new DateField('date_start');
            $this->dataset->AddField($field, false);
            $field = new DateField('date_end');
            $this->dataset->AddField($field, false);
            $field = new StringField('task_name');
            $this->dataset->AddField($field, false);
            $field = new StringField('notes');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('hrs');
            $this->dataset->AddField($field, false);
            $field = new StringField('wo');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('staff_id');
            if (!$this->GetSecurityInfo()->AdminGrant())
              $field->SetReadOnly(true, GetApplication()->GetCurrentUserId());
            $this->dataset->AddField($field, false);
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        public function GetPageList()
        {
            return null;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl(Grid $grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('taskDetailEdit0projectssearch', $this->dataset,
                array('project_id', 'date_start', 'date_end', 'task_name', 'notes', 'hrs', 'assigned_to'),
                array($this->RenderText('Parent Project'), $this->RenderText('Date Start'), $this->RenderText('Date End'), $this->RenderText('Task Name'), $this->RenderText('Notes'), $this->RenderText('Hrs'), $this->RenderText('Assigned To')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl(Grid $grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('taskDetailEdit0projectasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('project_id', $this->RenderText('Parent Project')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('date_start', $this->RenderText('Date Start'), 'Y-m-d'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('date_end', $this->RenderText('Date End'), 'Y-m-d'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('task_name', $this->RenderText('Task Name')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('notes', $this->RenderText('Notes')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('hrs', $this->RenderText('Hrs')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('assigned_to', $this->RenderText('Assigned To')));
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/view_action.png');
            }
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/edit_action.png');
                $column->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/delete_action.png');
                $column->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $column->SetAdditionalAttribute('data-modal-delete', 'true');
                $column->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            if (GetCurrentUserGrantForDataSource('task.timesheet')->HasViewGrant())
            {
              //
            // View column for timesheetDetailView0taskDetailEdit0project detail
            //
            $column = new DetailColumn(array('task_id'), 'detail0taskDetailEdit0project', 'timesheetDetailEdit0taskDetailEdit0project_handler', 'timesheetDetailView0taskDetailEdit0project_handler', $this->dataset, 'Time Tracking for this Task', $this->RenderText('TimeTracking'));
              $grid->AddViewColumn($column);
            }
            
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Parent Project', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('taskDetailEditGrid0project_task_name_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('taskDetailEditGrid0project_notes_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for hrs field
            //
            $column = new TextViewColumn('hrs', 'Hrs', $this->dataset);
            $grid->SetTotal($column, PredefinedAggregate::$Sum);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Parent Project', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('taskDetailEditGrid0project_task_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('taskDetailEditGrid0project_notes_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for hrs field
            //
            $column = new TextViewColumn('hrs', 'Hrs', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for project_id field
            //
            $editor = new ComboBox('project_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Parent Project', 'project_id', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->setEnabled(false);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for date_start field
            //
            $editor = new DateTimeEdit('date_start_edit', false, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date Start', 'date_start', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for date_end field
            //
            $editor = new DateTimeEdit('date_end_edit', false, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date End', 'date_end', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for task_name field
            //
            $editor = new ComboBox('task_name_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Task Name', 'task_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for hrs field
            //
            $editor = new SpinEdit('hrs_edit');
            $editColumn = new CustomEditColumn('Hrs', 'hrs', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for assigned_to field
            //
            $editor = new ComboBox('assigned_to_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Assigned To', 'assigned_to', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for project_id field
            //
            $editor = new ComboBox('project_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Parent Project', 'project_id', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->setEnabled(false);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue($this->RenderText('%project_name%'));
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for date_start field
            //
            $editor = new DateTimeEdit('date_start_edit', false, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date Start', 'date_start', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for date_end field
            //
            $editor = new DateTimeEdit('date_end_edit', false, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date End', 'date_end', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for task_name field
            //
            $editor = new ComboBox('task_name_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Task Name', 'task_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notes', 'notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for hrs field
            //
            $editor = new SpinEdit('hrs_edit');
            $editColumn = new CustomEditColumn('Hrs', 'hrs', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue($this->RenderText('21'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for assigned_to field
            //
            $editor = new ComboBox('assigned_to_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Assigned To', 'assigned_to', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue($this->RenderText('%CURRENT_USER_ID%'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(true);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Parent Project', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for hrs field
            //
            $column = new TextViewColumn('hrs', 'Hrs', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Parent Project', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for hrs field
            //
            $column = new TextViewColumn('hrs', 'Hrs', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $grid->AddExportColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
        	$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function CreateMasterDetailRecordGridFortimesheetDetailEdit0taskDetailEdit0projectGrid()
        {
            $result = new Grid($this, $this->dataset, 'MasterDetailRecordGridFortimesheetDetailEdit0taskDetailEdit0project');
            $result->SetAllowDeleteSelected(false);
            $result->OnCustomDrawCell->AddListener('MasterDetailRecordGridFortimesheetDetailEdit0taskDetailEdit0project' . '_OnCustomDrawRow', $this);
            $result->SetShowFilterBuilder(false);
            $result->SetAdvancedSearchAvailable(false);
            $result->SetFilterRowAvailable(false);
            $result->SetShowUpdateLink(false);
            $result->SetEnabledInlineEditing(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetName('master_grid');
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Parent Project', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('taskGrid_task_name_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('taskGrid_notes_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for hrs field
            //
            $column = new TextViewColumn('hrs', 'Hrs', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Parent Project', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for hrs field
            //
            $column = new TextViewColumn('hrs', 'Hrs', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $result->AddPrintColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            return $result;
        }
        
        public function MasterDetailRecordGridFortimesheetDetailEdit0taskDetailEdit0project_OnCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles)
        {
        $rowStyles = 'background-color: #F6D8CE';
        }
        
        function BeforeBeginRenderPage()
        {
            if ($this->GetRecordPermission() != null)
        	       if (!$this->GetRecordPermission()->CanAllUsersViewRecords())
                     if (GetApplication()->GetCurrentUserId() == null)
                         $this->dataset->AddFieldFilter('staff_id', new IsNullFieldFilter());
                     else
        		             $this->dataset->AddFieldFilter('staff_id', new FieldFilter(GetApplication()->GetCurrentUserId(), '='));
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function taskDetailEditGrid0project_OnCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles)
        {
        $rowStyles = 'background-color: #F6D8CE';
        }
        function taskDetailEditGrid0project_BeforeUpdateRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            if (isProjectApproved($page->GetConnection())) {
              $cancel = true;
              $message = 'You cannot change a task that belongs to an approved project'; }
            
            else
            $rowData['staff_id'] = $rowData['assigned_to'];
        }
        function taskDetailEditGrid0project_BeforeDeleteRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            if (isProjectApproved($page->GetConnection())) {
              $cancel = true;
              $message = 'You cannot delete a task from an approved project'; }
        }
        function taskDetailEditGrid0project_BeforeInsertRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            if (isProjectApproved($page->GetConnection())) {
              $cancel = true;
              $message = 'You cannot add a task to an approved project.'; }
            else
            $rowData['staff_id'] = $rowData['assigned_to'];
        }
        public function ShowEditButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasEditGrant($this->GetDataset());
        }
        public function ShowDeleteButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasDeleteGrant($this->GetDataset());
        }
        
        public function GetModalGridDeleteHandler() { return 'taskDetailEdit0project_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'taskDetailEditGrid0project');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
                $result->SetAllowDeleteSelected(false);
            else
                $result->SetAllowDeleteSelected(false);
            ApplyCommonPageSettings($this, $result);
            $result->SetUseImagesForActions(true);
            $result->SetInsertClientValidationScript($this->RenderText('if (fieldValues[\'project_id\'] ==\'\')
            
            {
            
                errorInfo.SetMessage(\'Only project lead may add tasks to this project.\'); 
            
                return false;
            
            }'));
            
            $result->SetInsertClientEditorValueChangedScript($this->RenderText('if (fieldValues[\'project_id\'] ==\'\')
            
            {
            
                errorInfo.SetMessage(\'Only project lead may add tasks to this project.\'); 
            
                return false;
            
            }'));
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(true);
            $result->SetWidth('');
            $result->OnCustomDrawCell->AddListener('taskDetailEditGrid0project' . '_OnCustomDrawRow', $this);
            $result->BeforeUpdateRecord->AddListener('taskDetailEditGrid0project' . '_' . 'BeforeUpdateRecord', $this);
            $result->BeforeDeleteRecord->AddListener('taskDetailEditGrid0project' . '_' . 'BeforeDeleteRecord', $this);
            $result->BeforeInsertRecord->AddListener('taskDetailEditGrid0project' . '_' . 'BeforeInsertRecord', $this);
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetHidePageListByDefault(false);
            $this->SetExportToExcelAvailable(true);
            $this->SetExportToWordAvailable(true);
            $this->SetExportToXmlAvailable(true);
            $this->SetExportToCsvAvailable(true);
            $this->SetExportToPdfAvailable(true);
            $this->SetPrinterFriendlyAvailable(true);
            $this->SetSimpleSearchAvailable(false);
            $this->SetAdvancedSearchAvailable(false);
            $this->SetFilterRowAvailable(true);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
    
            //
            // Http Handlers
            //
            $pageView = new timesheetDetailView0taskDetailEdit0projectPage($this, 'TimeTracking', 'TimeTracking', array('task_id'), GetCurrentUserGrantForDataSource('task.timesheet'), 'UTF-8', 20, 'timesheetDetailEdit0taskDetailEdit0project_handler');
            
            $pageView->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('task.timesheet'));
            $handler = new PageHTTPHandler('timesheetDetailView0taskDetailEdit0project_handler', $pageView);
            GetApplication()->RegisterHTTPHandler($handler);
            $pageEdit = new timesheetDetailEdit0taskDetailEdit0projectPage($this, array('task_id'), array('task_id'), $this->GetForeingKeyFields(), $this->CreateMasterDetailRecordGridFortimesheetDetailEdit0taskDetailEdit0projectGrid(), $this->dataset, GetCurrentUserGrantForDataSource('task.timesheet'), 'UTF-8');
            
            $pageEdit->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('task.timesheet'));
            $pageEdit->SetShortCaption('Time Tracking for this Task');
            $pageEdit->SetHeader(GetPagesHeader());
            $pageEdit->SetFooter(GetPagesFooter());
            $pageEdit->SetCaption('TimeTracking');
            $pageEdit->SetHttpHandlerName('timesheetDetailEdit0taskDetailEdit0project_handler');
            $handler = new PageHTTPHandler('timesheetDetailEdit0taskDetailEdit0project_handler', $pageEdit);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'taskDetailEditGrid0project_task_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'taskDetailEditGrid0project_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'taskDetailEditGrid0project_task_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'taskDetailEditGrid0project_notes_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
        
        public function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }    
    }
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class project_timeline_detailDetailView1projectPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $selectQuery = 'SELECT 
              `project`.`project_name`,
              `project`.`date_start` AS project_date_start,
              `project`.`date_end` AS project_date_end,
              `project`.`lead`,
              `project`.`year`,
              `project`.`progress`,
              `project`.`project_id`,
              `task`.`task_id`,
              `task`.`project_id` AS task_project_id,
              `task`.`assigned_to`,
              `task`.`date_start` AS task_date_start,
              `task`.`date_end` AS task_date_end,
              `task`.`task_name`,
              `task`.`staff_id`
            FROM
              `project`
              INNER JOIN `task` ON (`project`.`project_id` = `task`.`project_id`)';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $this->dataset = new QueryDataset(
              new MyConnectionFactory(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'project_timeline_detail');
            $field = new StringField('project_name');
            $this->dataset->AddField($field, false);
            $field = new DateField('project_date_start');
            $this->dataset->AddField($field, false);
            $field = new DateField('project_date_end');
            $this->dataset->AddField($field, false);
            $field = new StringField('lead');
            $this->dataset->AddField($field, false);
            $field = new StringField('year');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('progress');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('project_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('task_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('task_project_id');
            $this->dataset->AddField($field, false);
            $field = new StringField('assigned_to');
            $this->dataset->AddField($field, false);
            $field = new DateField('task_date_start');
            $this->dataset->AddField($field, false);
            $field = new DateField('task_date_end');
            $this->dataset->AddField($field, false);
            $field = new StringField('task_name');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('staff_id');
            $this->dataset->AddField($field, false);
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for project_date_start field
            //
            $column = new DateTimeViewColumn('project_date_start', 'Project Date Start', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for project_date_end field
            //
            $column = new DateTimeViewColumn('project_date_end', 'Project Date End', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Lead', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Project Id', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task Id', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_project_id field
            //
            $column = new TextViewColumn('task_project_id', 'Task Project Id', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_date_start field
            //
            $column = new DateTimeViewColumn('task_date_start', 'Task Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_date_end field
            //
            $column = new DateTimeViewColumn('task_date_end', 'Task Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'project_timeline_detailDetailViewGrid1project');
            $result->SetAllowDeleteSelected(false);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddFieldColumns($result);
    
            return $result;
        }
    }
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class project_timeline_detailDetailEdit1projectPage extends DetailPageEdit
    {
        protected function DoBeforeCreate()
        {
            $selectQuery = 'SELECT 
              `project`.`project_name`,
              `project`.`date_start` AS project_date_start,
              `project`.`date_end` AS project_date_end,
              `project`.`lead`,
              `project`.`year`,
              `project`.`progress`,
              `project`.`project_id`,
              `task`.`task_id`,
              `task`.`project_id` AS task_project_id,
              `task`.`assigned_to`,
              `task`.`date_start` AS task_date_start,
              `task`.`date_end` AS task_date_end,
              `task`.`task_name`,
              `task`.`staff_id`
            FROM
              `project`
              INNER JOIN `task` ON (`project`.`project_id` = `task`.`project_id`)';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $this->dataset = new QueryDataset(
              new MyConnectionFactory(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'project_timeline_detail');
            $field = new StringField('project_name');
            $this->dataset->AddField($field, false);
            $field = new DateField('project_date_start');
            $this->dataset->AddField($field, false);
            $field = new DateField('project_date_end');
            $this->dataset->AddField($field, false);
            $field = new StringField('lead');
            $this->dataset->AddField($field, false);
            $field = new StringField('year');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('progress');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('project_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('task_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('task_project_id');
            $this->dataset->AddField($field, false);
            $field = new StringField('assigned_to');
            $this->dataset->AddField($field, false);
            $field = new DateField('task_date_start');
            $this->dataset->AddField($field, false);
            $field = new DateField('task_date_end');
            $this->dataset->AddField($field, false);
            $field = new StringField('task_name');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('staff_id');
            $this->dataset->AddField($field, false);
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            return null;
        }
    
        public function GetPageList()
        {
            return null;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl(Grid $grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('project_timeline_detailDetailEdit1projectssearch', $this->dataset,
                array('project_name', 'project_date_start', 'project_date_end', 'lead', 'year', 'progress', 'project_id', 'task_id', 'task_project_id', 'assigned_to', 'task_date_start', 'task_date_end', 'task_name'),
                array($this->RenderText('Project Name'), $this->RenderText('Project Date Start'), $this->RenderText('Project Date End'), $this->RenderText('Lead'), $this->RenderText('Year'), $this->RenderText('Progress'), $this->RenderText('Project Id'), $this->RenderText('Task Id'), $this->RenderText('Task Project Id'), $this->RenderText('Assigned To'), $this->RenderText('Task Date Start'), $this->RenderText('Task Date End'), $this->RenderText('Task Name')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl(Grid $grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('project_timeline_detailDetailEdit1projectasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('project_name', $this->RenderText('Project Name')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('project_date_start', $this->RenderText('Project Date Start'), 'd-m-Y'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('project_date_end', $this->RenderText('Project Date End'), 'd-m-Y'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('lead', $this->RenderText('Lead')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('year', $this->RenderText('Year')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('progress', $this->RenderText('Progress')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('project_id', $this->RenderText('Project Id')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('task_id', $this->RenderText('Task Id')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('task_project_id', $this->RenderText('Task Project Id')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('assigned_to', $this->RenderText('Assigned To')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('task_date_start', $this->RenderText('Task Date Start'), 'Y-m-d'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('task_date_end', $this->RenderText('Task Date End'), 'Y-m-d'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('task_name', $this->RenderText('Task Name')));
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/view_action.png');
            }
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for project_date_start field
            //
            $column = new DateTimeViewColumn('project_date_start', 'Project Date Start', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for project_date_end field
            //
            $column = new DateTimeViewColumn('project_date_end', 'Project Date End', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Lead', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Project Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_project_id field
            //
            $column = new TextViewColumn('task_project_id', 'Task Project Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_date_start field
            //
            $column = new DateTimeViewColumn('task_date_start', 'Task Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_date_end field
            //
            $column = new DateTimeViewColumn('task_date_end', 'Task Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for project_date_start field
            //
            $column = new DateTimeViewColumn('project_date_start', 'Project Date Start', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for project_date_end field
            //
            $column = new DateTimeViewColumn('project_date_end', 'Project Date End', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Lead', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Project Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for task_project_id field
            //
            $column = new TextViewColumn('task_project_id', 'Task Project Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for task_date_start field
            //
            $column = new DateTimeViewColumn('task_date_start', 'Task Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for task_date_end field
            //
            $column = new DateTimeViewColumn('task_date_end', 'Task Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for project_name field
            //
            $editor = new TextEdit('project_name_edit');
            $editColumn = new CustomEditColumn('Project Name', 'project_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for project_date_start field
            //
            $editor = new DateTimeEdit('project_date_start_edit', false, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Project Date Start', 'project_date_start', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for project_date_end field
            //
            $editor = new DateTimeEdit('project_date_end_edit', false, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Project Date End', 'project_date_end', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for lead field
            //
            $editor = new TextEdit('lead_edit');
            $editColumn = new CustomEditColumn('Lead', 'lead', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for year field
            //
            $editor = new TextEdit('year_edit');
            $editColumn = new CustomEditColumn('Year', 'year', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for progress field
            //
            $editor = new TextEdit('progress_edit');
            $editColumn = new CustomEditColumn('Progress', 'progress', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for project_id field
            //
            $editor = new SpinEdit('project_id_edit');
            $editColumn = new CustomEditColumn('Project Id', 'project_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for task_id field
            //
            $editor = new SpinEdit('task_id_edit');
            $editColumn = new CustomEditColumn('Task Id', 'task_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for task_project_id field
            //
            $editor = new SpinEdit('task_project_id_edit');
            $editColumn = new CustomEditColumn('Task Project Id', 'task_project_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for assigned_to field
            //
            $editor = new TextEdit('assigned_to_edit');
            $editColumn = new CustomEditColumn('Assigned To', 'assigned_to', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for task_date_start field
            //
            $editor = new DateTimeEdit('task_date_start_edit', false, 'Y-m-d ', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Task Date Start', 'task_date_start', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for task_date_end field
            //
            $editor = new DateTimeEdit('task_date_end_edit', false, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Task Date End', 'task_date_end', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for task_name field
            //
            $editor = new TextEdit('task_name_edit');
            $editColumn = new CustomEditColumn('Task Name', 'task_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for project_name field
            //
            $editor = new TextEdit('project_name_edit');
            $editColumn = new CustomEditColumn('Project Name', 'project_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for project_date_start field
            //
            $editor = new DateTimeEdit('project_date_start_edit', false, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Project Date Start', 'project_date_start', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for project_date_end field
            //
            $editor = new DateTimeEdit('project_date_end_edit', false, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Project Date End', 'project_date_end', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for lead field
            //
            $editor = new TextEdit('lead_edit');
            $editColumn = new CustomEditColumn('Lead', 'lead', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for year field
            //
            $editor = new TextEdit('year_edit');
            $editColumn = new CustomEditColumn('Year', 'year', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for progress field
            //
            $editor = new TextEdit('progress_edit');
            $editColumn = new CustomEditColumn('Progress', 'progress', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for project_id field
            //
            $editor = new SpinEdit('project_id_edit');
            $editColumn = new CustomEditColumn('Project Id', 'project_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for task_id field
            //
            $editor = new SpinEdit('task_id_edit');
            $editColumn = new CustomEditColumn('Task Id', 'task_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for task_project_id field
            //
            $editor = new SpinEdit('task_project_id_edit');
            $editColumn = new CustomEditColumn('Task Project Id', 'task_project_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for assigned_to field
            //
            $editor = new TextEdit('assigned_to_edit');
            $editColumn = new CustomEditColumn('Assigned To', 'assigned_to', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for task_date_start field
            //
            $editor = new DateTimeEdit('task_date_start_edit', false, 'Y-m-d ', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Task Date Start', 'task_date_start', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for task_date_end field
            //
            $editor = new DateTimeEdit('task_date_end_edit', false, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Task Date End', 'task_date_end', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for task_name field
            //
            $editor = new TextEdit('task_name_edit');
            $editColumn = new CustomEditColumn('Task Name', 'task_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(false);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for project_date_start field
            //
            $column = new DateTimeViewColumn('project_date_start', 'Project Date Start', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for project_date_end field
            //
            $column = new DateTimeViewColumn('project_date_end', 'Project Date End', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Lead', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Project Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for task_project_id field
            //
            $column = new TextViewColumn('task_project_id', 'Task Project Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for task_date_start field
            //
            $column = new DateTimeViewColumn('task_date_start', 'Task Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for task_date_end field
            //
            $column = new DateTimeViewColumn('task_date_end', 'Task Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for project_date_start field
            //
            $column = new DateTimeViewColumn('project_date_start', 'Project Date Start', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for project_date_end field
            //
            $column = new DateTimeViewColumn('project_date_end', 'Project Date End', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Lead', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Project Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for task_id field
            //
            $column = new TextViewColumn('task_id', 'Task Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for task_project_id field
            //
            $column = new TextViewColumn('task_project_id', 'Task Project Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for assigned_to field
            //
            $column = new TextViewColumn('assigned_to', 'Assigned To', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for task_date_start field
            //
            $column = new DateTimeViewColumn('task_date_start', 'Task Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for task_date_end field
            //
            $column = new DateTimeViewColumn('task_date_end', 'Task Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for task_name field
            //
            $column = new TextViewColumn('task_name', 'Task Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
        	$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function project_timeline_detailDetailEditGrid1project_OnGetCustomTemplate($part, $mode, &$result, &$params)
        {
        if ($part == PagePart::Grid && $mode == PageMode::ViewAll)
          $result = 'task_view_timeline1.tpl';
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'project_timeline_detailDetailEditGrid1project');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
                $result->SetAllowDeleteSelected(false);
            else
                $result->SetAllowDeleteSelected(false);
            ApplyCommonPageSettings($this, $result);
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->OnGetCustomTemplate->AddListener('project_timeline_detailDetailEditGrid1project' . '_OnGetCustomTemplate', $this);
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetHidePageListByDefault(false);
            $this->SetExportToExcelAvailable(true);
            $this->SetExportToWordAvailable(true);
            $this->SetExportToXmlAvailable(true);
            $this->SetExportToCsvAvailable(true);
            $this->SetExportToPdfAvailable(true);
            $this->SetPrinterFriendlyAvailable(true);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(true);
            $this->SetFilterRowAvailable(true);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(false);
            $this->SetShowBottomPageNavigator(false);
    
            //
            // Http Handlers
            //
    
            return $result;
        }
        
        public function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }    
    }
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class ProjectViewDetailView2projectPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyConnectionFactory(),
                GetConnectionOptions(),
                '`ProjectView`');
            $field = new IntegerField('project_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('project_type');
            $this->dataset->AddField($field, true);
            $field = new StringField('project_name');
            $this->dataset->AddField($field, true);
            $field = new DateField('date_start');
            $this->dataset->AddField($field, true);
            $field = new DateField('date_end');
            $this->dataset->AddField($field, true);
            $field = new StringField('year');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('Objective');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('priority');
            $this->dataset->AddField($field, true);
            $field = new StringField('project_lead');
            $this->dataset->AddField($field, true);
            $field = new IntegerField('approved_budget');
            $this->dataset->AddField($field, true);
            $field = new IntegerField('budget_spent');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('multi_year');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('public_engagement');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('level_of_service');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('approved_by_cao');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('progress');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('DEPARTMENT');
            $this->dataset->AddField($field, true);
            $field = new IntegerField('total_hours');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('assigned_hours');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('assigned_progress');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Project Id', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for project_type field
            //
            $column = new TextViewColumn('project_type', 'Project Type', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(false);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ProjectViewDetailViewGrid2project_project_name_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Objective field
            //
            $column = new TextViewColumn('Objective', 'Objective', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(false);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ProjectViewDetailViewGrid2project_priority_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for project_lead field
            //
            $column = new TextViewColumn('project_lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(false);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ProjectViewDetailViewGrid2project_project_lead_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(false);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ProjectViewDetailViewGrid2project_public_engagement_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for approved_by_cao field
            //
            $column = new TextViewColumn('approved_by_cao', 'Approved By Cao', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for DEPARTMENT field
            //
            $column = new TextViewColumn('DEPARTMENT', 'DEPARTMENT', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for total_hours field
            //
            $column = new TextViewColumn('total_hours', 'Total Hours', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '', '.');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for assigned_hours field
            //
            $column = new TextViewColumn('assigned_hours', 'Assigned Hours', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '', '.');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for assigned_progress field
            //
            $column = new TextViewColumn('assigned_progress', 'Assigned Progress', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'ProjectViewDetailViewGrid2project');
            $result->SetAllowDeleteSelected(false);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddFieldColumns($result);
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(false);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ProjectViewDetailViewGrid2project_project_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(false);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ProjectViewDetailViewGrid2project_priority_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for project_lead field
            //
            $column = new TextViewColumn('project_lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(false);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ProjectViewDetailViewGrid2project_project_lead_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(false);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ProjectViewDetailViewGrid2project_public_engagement_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
    }
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class ProjectViewDetailEdit2projectPage extends DetailPageEdit
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyConnectionFactory(),
                GetConnectionOptions(),
                '`ProjectView`');
            $field = new IntegerField('project_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('project_type');
            $this->dataset->AddField($field, true);
            $field = new StringField('project_name');
            $this->dataset->AddField($field, true);
            $field = new DateField('date_start');
            $this->dataset->AddField($field, true);
            $field = new DateField('date_end');
            $this->dataset->AddField($field, true);
            $field = new StringField('year');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('Objective');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('priority');
            $this->dataset->AddField($field, true);
            $field = new StringField('project_lead');
            $this->dataset->AddField($field, true);
            $field = new IntegerField('approved_budget');
            $this->dataset->AddField($field, true);
            $field = new IntegerField('budget_spent');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('multi_year');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('public_engagement');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('level_of_service');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('approved_by_cao');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('progress');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('DEPARTMENT');
            $this->dataset->AddField($field, true);
            $field = new IntegerField('total_hours');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('assigned_hours');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('assigned_progress');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            return null;
        }
    
        public function GetPageList()
        {
            return null;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl(Grid $grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('ProjectViewDetailEdit2projectssearch', $this->dataset,
                array('project_id', 'project_type', 'project_name', 'date_start', 'date_end', 'year', 'Objective', 'priority', 'project_lead', 'approved_budget', 'budget_spent', 'multi_year', 'public_engagement', 'level_of_service', 'approved_by_cao', 'progress', 'DEPARTMENT', 'total_hours', 'assigned_hours', 'assigned_progress'),
                array($this->RenderText('Project Id'), $this->RenderText('Project Type'), $this->RenderText('Project Name'), $this->RenderText('Date Start'), $this->RenderText('Date End'), $this->RenderText('Year'), $this->RenderText('Objective'), $this->RenderText('Priority'), $this->RenderText('Project Lead'), $this->RenderText('Approved Budget'), $this->RenderText('Budget Spent'), $this->RenderText('Multi Year'), $this->RenderText('Public Engagement'), $this->RenderText('Level Of Service'), $this->RenderText('Approved By Cao'), $this->RenderText('Progress'), $this->RenderText('DEPARTMENT'), $this->RenderText('Total Hours'), $this->RenderText('Assigned Hours'), $this->RenderText('Assigned Progress')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl(Grid $grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('ProjectViewDetailEdit2projectasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('project_id', $this->RenderText('Project Id')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('project_type', $this->RenderText('Project Type')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('project_name', $this->RenderText('Project Name')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('date_start', $this->RenderText('Date Start'), 'Y-m-d H:i:s'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('date_end', $this->RenderText('Date End'), 'Y-m-d H:i:s'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('year', $this->RenderText('Year')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('Objective', $this->RenderText('Objective')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('priority', $this->RenderText('Priority')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('project_lead', $this->RenderText('Project Lead')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('approved_budget', $this->RenderText('Approved Budget')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('budget_spent', $this->RenderText('Budget Spent')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('multi_year', $this->RenderText('Multi Year')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('public_engagement', $this->RenderText('Public Engagement')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('level_of_service', $this->RenderText('Level Of Service')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('approved_by_cao', $this->RenderText('Approved By Cao')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('progress', $this->RenderText('Progress')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('DEPARTMENT', $this->RenderText('DEPARTMENT')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('total_hours', $this->RenderText('Total Hours')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('assigned_hours', $this->RenderText('Assigned Hours')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('assigned_progress', $this->RenderText('Assigned Progress')));
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/view_action.png');
            }
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/edit_action.png');
                $column->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/delete_action.png');
                $column->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $column->SetAdditionalAttribute('data-modal-delete', 'true');
                $column->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/copy_action.png');
            }
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Project Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for project_type field
            //
            $column = new TextViewColumn('project_type', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ProjectViewDetailEditGrid2project_project_name_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Objective field
            //
            $column = new TextViewColumn('Objective', 'Objective', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ProjectViewDetailEditGrid2project_priority_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for project_lead field
            //
            $column = new TextViewColumn('project_lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ProjectViewDetailEditGrid2project_project_lead_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ProjectViewDetailEditGrid2project_public_engagement_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for approved_by_cao field
            //
            $column = new TextViewColumn('approved_by_cao', 'Approved By Cao', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for DEPARTMENT field
            //
            $column = new TextViewColumn('DEPARTMENT', 'DEPARTMENT', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for total_hours field
            //
            $column = new TextViewColumn('total_hours', 'Total Hours', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '', '.');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for assigned_hours field
            //
            $column = new TextViewColumn('assigned_hours', 'Assigned Hours', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '', '.');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for assigned_progress field
            //
            $column = new TextViewColumn('assigned_progress', 'Assigned Progress', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Project Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for project_type field
            //
            $column = new TextViewColumn('project_type', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ProjectViewDetailEditGrid2project_project_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Objective field
            //
            $column = new TextViewColumn('Objective', 'Objective', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ProjectViewDetailEditGrid2project_priority_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for project_lead field
            //
            $column = new TextViewColumn('project_lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ProjectViewDetailEditGrid2project_project_lead_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('ProjectViewDetailEditGrid2project_public_engagement_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for approved_by_cao field
            //
            $column = new TextViewColumn('approved_by_cao', 'Approved By Cao', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DEPARTMENT field
            //
            $column = new TextViewColumn('DEPARTMENT', 'DEPARTMENT', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for total_hours field
            //
            $column = new TextViewColumn('total_hours', 'Total Hours', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '', '.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for assigned_hours field
            //
            $column = new TextViewColumn('assigned_hours', 'Assigned Hours', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '', '.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for assigned_progress field
            //
            $column = new TextViewColumn('assigned_progress', 'Assigned Progress', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for project_id field
            //
            $editor = new TextEdit('project_id_edit');
            $editColumn = new CustomEditColumn('Project Id', 'project_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for project_type field
            //
            $editor = new TextEdit('project_type_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Project Type', 'project_type', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for project_name field
            //
            $editor = new TextAreaEdit('project_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Project Name', 'project_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for date_start field
            //
            $editor = new DateTimeEdit('date_start_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date Start', 'date_start', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for date_end field
            //
            $editor = new DateTimeEdit('date_end_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date End', 'date_end', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for year field
            //
            $editor = new TextEdit('year_edit');
            $editor->SetSize(4);
            $editor->SetMaxLength(4);
            $editColumn = new CustomEditColumn('Year', 'year', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Objective field
            //
            $editor = new TextEdit('objective_edit');
            $editColumn = new CustomEditColumn('Objective', 'Objective', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for priority field
            //
            $editor = new TextEdit('priority_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Priority', 'priority', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for project_lead field
            //
            $editor = new TextEdit('project_lead_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Project Lead', 'project_lead', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for approved_budget field
            //
            $editor = new TextEdit('approved_budget_edit');
            $editColumn = new CustomEditColumn('Approved Budget', 'approved_budget', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for budget_spent field
            //
            $editor = new TextEdit('budget_spent_edit');
            $editColumn = new CustomEditColumn('Budget Spent', 'budget_spent', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for multi_year field
            //
            $editor = new TextEdit('multi_year_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Multi Year', 'multi_year', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for public_engagement field
            //
            $editor = new TextEdit('public_engagement_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Public Engagement', 'public_engagement', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for level_of_service field
            //
            $editor = new TextEdit('level_of_service_edit');
            $editor->SetSize(55);
            $editor->SetMaxLength(55);
            $editColumn = new CustomEditColumn('Level Of Service', 'level_of_service', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for approved_by_cao field
            //
            $editor = new TextEdit('approved_by_cao_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Approved By Cao', 'approved_by_cao', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for progress field
            //
            $editor = new TextEdit('progress_edit');
            $editColumn = new CustomEditColumn('Progress', 'progress', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for DEPARTMENT field
            //
            $editor = new TextEdit('department_edit');
            $editor->SetSize(20);
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('DEPARTMENT', 'DEPARTMENT', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for total_hours field
            //
            $editor = new TextEdit('total_hours_edit');
            $editColumn = new CustomEditColumn('Total Hours', 'total_hours', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for assigned_hours field
            //
            $editor = new TextEdit('assigned_hours_edit');
            $editColumn = new CustomEditColumn('Assigned Hours', 'assigned_hours', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for assigned_progress field
            //
            $editor = new TextEdit('assigned_progress_edit');
            $editColumn = new CustomEditColumn('Assigned Progress', 'assigned_progress', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for project_id field
            //
            $editor = new TextEdit('project_id_edit');
            $editColumn = new CustomEditColumn('Project Id', 'project_id', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for project_type field
            //
            $editor = new TextEdit('project_type_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Project Type', 'project_type', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for project_name field
            //
            $editor = new TextAreaEdit('project_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Project Name', 'project_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for date_start field
            //
            $editor = new DateTimeEdit('date_start_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date Start', 'date_start', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for date_end field
            //
            $editor = new DateTimeEdit('date_end_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date End', 'date_end', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for year field
            //
            $editor = new TextEdit('year_edit');
            $editor->SetSize(4);
            $editor->SetMaxLength(4);
            $editColumn = new CustomEditColumn('Year', 'year', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Objective field
            //
            $editor = new TextEdit('objective_edit');
            $editColumn = new CustomEditColumn('Objective', 'Objective', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for priority field
            //
            $editor = new TextEdit('priority_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Priority', 'priority', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for project_lead field
            //
            $editor = new TextEdit('project_lead_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Project Lead', 'project_lead', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for approved_budget field
            //
            $editor = new TextEdit('approved_budget_edit');
            $editColumn = new CustomEditColumn('Approved Budget', 'approved_budget', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for budget_spent field
            //
            $editor = new TextEdit('budget_spent_edit');
            $editColumn = new CustomEditColumn('Budget Spent', 'budget_spent', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for multi_year field
            //
            $editor = new TextEdit('multi_year_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Multi Year', 'multi_year', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for public_engagement field
            //
            $editor = new TextEdit('public_engagement_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Public Engagement', 'public_engagement', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for level_of_service field
            //
            $editor = new TextEdit('level_of_service_edit');
            $editor->SetSize(55);
            $editor->SetMaxLength(55);
            $editColumn = new CustomEditColumn('Level Of Service', 'level_of_service', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for approved_by_cao field
            //
            $editor = new TextEdit('approved_by_cao_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Approved By Cao', 'approved_by_cao', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for progress field
            //
            $editor = new TextEdit('progress_edit');
            $editColumn = new CustomEditColumn('Progress', 'progress', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for DEPARTMENT field
            //
            $editor = new TextEdit('department_edit');
            $editor->SetSize(20);
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('DEPARTMENT', 'DEPARTMENT', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for total_hours field
            //
            $editor = new TextEdit('total_hours_edit');
            $editColumn = new CustomEditColumn('Total Hours', 'total_hours', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for assigned_hours field
            //
            $editor = new TextEdit('assigned_hours_edit');
            $editColumn = new CustomEditColumn('Assigned Hours', 'assigned_hours', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for assigned_progress field
            //
            $editor = new TextEdit('assigned_progress_edit');
            $editColumn = new CustomEditColumn('Assigned Progress', 'assigned_progress', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(true);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Project Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for project_type field
            //
            $column = new TextViewColumn('project_type', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Objective field
            //
            $column = new TextViewColumn('Objective', 'Objective', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for project_lead field
            //
            $column = new TextViewColumn('project_lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for approved_by_cao field
            //
            $column = new TextViewColumn('approved_by_cao', 'Approved By Cao', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for DEPARTMENT field
            //
            $column = new TextViewColumn('DEPARTMENT', 'DEPARTMENT', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for total_hours field
            //
            $column = new TextViewColumn('total_hours', 'Total Hours', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '', '.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for assigned_hours field
            //
            $column = new TextViewColumn('assigned_hours', 'Assigned Hours', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '', '.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for assigned_progress field
            //
            $column = new TextViewColumn('assigned_progress', 'Assigned Progress', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for project_id field
            //
            $column = new TextViewColumn('project_id', 'Project Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for project_type field
            //
            $column = new TextViewColumn('project_type', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Objective field
            //
            $column = new TextViewColumn('Objective', 'Objective', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for project_lead field
            //
            $column = new TextViewColumn('project_lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for approved_by_cao field
            //
            $column = new TextViewColumn('approved_by_cao', 'Approved By Cao', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, ',', '.');
            $grid->AddExportColumn($column);
            
            //
            // View column for DEPARTMENT field
            //
            $column = new TextViewColumn('DEPARTMENT', 'DEPARTMENT', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for total_hours field
            //
            $column = new TextViewColumn('total_hours', 'Total Hours', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '', '.');
            $grid->AddExportColumn($column);
            
            //
            // View column for assigned_hours field
            //
            $column = new TextViewColumn('assigned_hours', 'Assigned Hours', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '', '.');
            $grid->AddExportColumn($column);
            
            //
            // View column for assigned_progress field
            //
            $column = new TextViewColumn('assigned_progress', 'Assigned Progress', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
        	$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function ProjectViewDetailEditGrid2project_OnGetCustomTemplate($part, $mode, &$result, &$params)
        {
        if ($part == PagePart::Grid && $mode == PageMode::ViewAll)
          $result = 'project_detail_barcharts.tpl';
        }
        public function ShowEditButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasEditGrant($this->GetDataset());
        }
        public function ShowDeleteButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasDeleteGrant($this->GetDataset());
        }
        
        public function GetModalGridDeleteHandler() { return 'ProjectViewDetailEdit2project_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'ProjectViewDetailEditGrid2project');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
                $result->SetAllowDeleteSelected(true);
            else
                $result->SetAllowDeleteSelected(false);
            ApplyCommonPageSettings($this, $result);
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->OnGetCustomTemplate->AddListener('ProjectViewDetailEditGrid2project' . '_OnGetCustomTemplate', $this);
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetHidePageListByDefault(false);
            $this->SetExportToExcelAvailable(true);
            $this->SetExportToWordAvailable(true);
            $this->SetExportToXmlAvailable(true);
            $this->SetExportToCsvAvailable(true);
            $this->SetExportToPdfAvailable(true);
            $this->SetPrinterFriendlyAvailable(true);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(true);
            $this->SetFilterRowAvailable(true);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(false);
            $this->SetShowBottomPageNavigator(false);
    
            //
            // Http Handlers
            //
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ProjectViewDetailEditGrid2project_project_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ProjectViewDetailEditGrid2project_priority_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for project_lead field
            //
            $column = new TextViewColumn('project_lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ProjectViewDetailEditGrid2project_project_lead_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ProjectViewDetailEditGrid2project_public_engagement_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ProjectViewDetailEditGrid2project_project_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ProjectViewDetailEditGrid2project_priority_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for project_lead field
            //
            $column = new TextViewColumn('project_lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ProjectViewDetailEditGrid2project_project_lead_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'ProjectViewDetailEditGrid2project_public_engagement_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
        
        public function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }    
    }
    // OnGlobalBeforePageExecute event handler
    
    
    // OnBeforePageExecute event handler
    
    
    
    class projectPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyConnectionFactory(),
                GetConnectionOptions(),
                '`project`');
            $field = new IntegerField('project_id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('programm_id');
            $this->dataset->AddField($field, false);
            $field = new StringField('project_name');
            $this->dataset->AddField($field, false);
            $field = new DateField('date_start');
            $this->dataset->AddField($field, false);
            $field = new DateField('date_end');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('approved_budget');
            $this->dataset->AddField($field, false);
            $field = new StringField('notes');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('priority');
            $this->dataset->AddField($field, false);
            $field = new StringField('lead');
            $this->dataset->AddField($field, false);
            $field = new StringField('level_of_service');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('multi_year');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('public_engagement');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('year');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('approved');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('progress');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('staff_id');
            if (!$this->GetSecurityInfo()->AdminGrant())
              $field->SetReadOnly(true, GetApplication()->GetCurrentUserId());
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('dept_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('budget_spent');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('admin_flag');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
        }
    
        protected function DoPrepare() {
            foreach ($this->GetGrid()->GetEditColumns() as $column) {
              if ($column->GetFieldName() == 'approved')
                $column->setEnabled(GetApplication()->HasAdminGrantForCurrentUser());
            }
            
            foreach ($this->GetGrid()->GetInsertColumns() as $column) {
              if ($column->GetFieldName() == 'approved')
                $column->setEnabled(GetApplication()->HasAdminGrantForCurrentUser());
            }
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new CustomPageNavigator('partition', $this, $this->dataset, $this->RenderText('Department'), $result);
            $partitionNavigator->OnGetPartitionCondition->AddListener('partition' . '_GetPartitionConditionHandler', $this);
            $partitionNavigator->OnGetPartitions->AddListener('partition' . '_GetPartitionsHandler', $this);
            $partitionNavigator->SetAllowViewAllRecords(true);
            $partitionNavigator->SetNavigationStyle(NS_LIST);
            $result->AddPageNavigator($partitionNavigator);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        public function GetPageList()
        {
            $currentPageCaption = $this->GetShortCaption();
            $result = new PageList($this);
            $result->AddGroup($this->RenderText('Default'));
            if (GetCurrentUserGrantForDataSource('Dashboard')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Dashboard'), 'Dashboard.php', $this->RenderText('Dashboard'), $currentPageCaption == $this->RenderText('Dashboard'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('program')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Project Type'), 'program.php', $this->RenderText('Project Type'), $currentPageCaption == $this->RenderText('Project Type'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('project')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('View all Projects'), 'project.php', $this->RenderText('Projects'), $currentPageCaption == $this->RenderText('View all Projects'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('task')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tasks - Time Tracking'), 'task.php', $this->RenderText('Tasks - Time Tracking'), $currentPageCaption == $this->RenderText('Tasks - Time Tracking'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('Hours per Project by user')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Hours per Project'), 'Hours per project by user.php', $this->RenderText('Hours per project'), $currentPageCaption == $this->RenderText('Hours per Project'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('staff')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Staff'), 'staff.php', $this->RenderText('Staff'), $currentPageCaption == $this->RenderText('Staff'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('department')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Department'), 'department.php', $this->RenderText('Department'), $currentPageCaption == $this->RenderText('Department'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('Priority')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Priority'), 'Priority.php', $this->RenderText('Priority'), $currentPageCaption == $this->RenderText('Priority'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('task_names')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Task Names'), 'task_names.php', $this->RenderText('Task Names'), $currentPageCaption == $this->RenderText('Task Names'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('View Pay Period')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('View Pay Period'), 'View_Pay_Period.php', $this->RenderText(''), $currentPageCaption == $this->RenderText('View Pay Period'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('department_projects')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Department Projects'), 'department_projects.php', $this->RenderText('Department Projects'), $currentPageCaption == $this->RenderText('Department Projects'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('Multiple Time Entry')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Multiple Time Entry'), 'multiple_time_entry.php', $this->RenderText('Multiple Time Entry'), $currentPageCaption == $this->RenderText('Multiple Time Entry'), false, $this->RenderText('Default')));
            
            if ( HasAdminPage() && GetApplication()->HasAdminGrantForCurrentUser() ) {
              $result->AddGroup('Admin area');
              $result->AddPage(new PageLink($this->GetLocalizerCaptions()->GetMessageString('AdminPage'), 'phpgen_admin.php', $this->GetLocalizerCaptions()->GetMessageString('AdminPage'), false, false, 'Admin area'));
            }
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl(Grid $grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('projectssearch', $this->dataset,
                array('programm_id', 'project_name', 'date_start', 'date_end', 'year', 'notes', 'priority', 'lead', 'approved_budget', 'budget_spent', 'multi_year', 'public_engagement', 'level_of_service', 'approved', 'progress', 'dept_id'),
                array($this->RenderText('Project Type'), $this->RenderText('Project Name'), $this->RenderText('Date Start'), $this->RenderText('Date End'), $this->RenderText('Year'), $this->RenderText('Objectives'), $this->RenderText('Priority'), $this->RenderText('Project Lead'), $this->RenderText('Approved Budget'), $this->RenderText('Budget Spent'), $this->RenderText('Multi Year'), $this->RenderText('Public Engagement'), $this->RenderText('Level Of Service'), $this->RenderText('Approved by CAO'), $this->RenderText('Progress'), $this->RenderText('Department')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl(Grid $grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('projectasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('programm_id', $this->RenderText('Project Type')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('project_name', $this->RenderText('Project Name')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('date_start', $this->RenderText('Date Start'), 'Y-m-d'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('date_end', $this->RenderText('Date End'), 'Y-m-d'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('year', $this->RenderText('Year')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('notes', $this->RenderText('Objectives')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('priority', $this->RenderText('Priority')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('lead', $this->RenderText('Project Lead')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('approved_budget', $this->RenderText('Approved Budget')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('budget_spent', $this->RenderText('Budget Spent')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('multi_year', $this->RenderText('Multi Year')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('public_engagement', $this->RenderText('Public Engagement')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('level_of_service', $this->RenderText('Level Of Service')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('approved', $this->RenderText('Approved by CAO')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('progress', $this->RenderText('Progress')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('dept_id', $this->RenderText('Department')));
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/view_action.png');
            }
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/edit_action.png');
                $column->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/delete_action.png');
                $column->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $column->SetAdditionalAttribute('data-modal-delete', 'true');
                $column->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            if (GetCurrentUserGrantForDataSource('project.task')->HasViewGrant())
            {
              //
            // View column for taskDetailView0project detail
            //
            $column = new DetailColumn(array('project_id'), 'detail0project', 'taskDetailEdit0project_handler', 'taskDetailView0project_handler', $this->dataset, 'Tasks within this project', $this->RenderText('Tasks'));
              $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserGrantForDataSource('project.project_timeline_detail')->HasViewGrant())
            {
              //
            // View column for project_timeline_detailDetailView1project detail
            //
            $column = new DetailColumn(array('project_id'), 'detail1project', 'project_timeline_detailDetailEdit1project_handler', 'project_timeline_detailDetailView1project_handler', $this->dataset, 'Tasks Gantt view', $this->RenderText('Tasks Gantt view'));
              $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserGrantForDataSource('project.ProjectView')->HasViewGrant())
            {
              //
            // View column for ProjectViewDetailView2project detail
            //
            $column = new DetailColumn(array('project_id'), 'detail2project', 'ProjectViewDetailEdit2project_handler', 'ProjectViewDetailView2project_handler', $this->dataset, 'Performance Charts', $this->RenderText('Performance Charts'));
              $grid->AddViewColumn($column);
            }
            
            //
            // View column for programm_id field
            //
            $column = new TextViewColumn('programm_id', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetWordWrap(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Objectives', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('projectGrid_notes_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $grid->SetTotal($column, PredefinedAggregate::$Sum);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $grid->SetTotal($column, PredefinedAggregate::$Sum);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('projectGrid_public_engagement_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for approved field
            //
            $column = new TextViewColumn('approved', 'Approved by CAO', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for dept_id field
            //
            $column = new TextViewColumn('dept_id', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for programm_id field
            //
            $column = new TextViewColumn('programm_id', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetWordWrap(false);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Objectives', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('projectGrid_notes_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('projectGrid_public_engagement_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for approved field
            //
            $column = new TextViewColumn('approved', 'Approved by CAO', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for dept_id field
            //
            $column = new TextViewColumn('dept_id', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for programm_id field
            //
            $editor = new ComboBox('programm_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Project Type', 'programm_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for project_name field
            //
            $editor = new TextEdit('project_name_edit');
            $editColumn = new CustomEditColumn('Project Name', 'project_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^[A-Za-z0-9 ()&]+[-]*[A-Za-z0-9 ()&]*$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for date_start field
            //
            $editor = new DateTimeEdit('date_start_edit', false, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date Start', 'date_start', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for date_end field
            //
            $editor = new DateTimeEdit('date_end_edit', true, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date End', 'date_end', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for year field
            //
            $editor = new TextEdit('year_edit');
            $editColumn = new CustomEditColumn('Year', 'year', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Objectives', 'notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for priority field
            //
            $editor = new ComboBox('priority_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Priority', 'priority', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for lead field
            //
            $editor = new ComboBox('lead_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Project Lead', 'lead', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for approved_budget field
            //
            $editor = new TextEdit('approved_budget_edit');
            $editor->SetPlaceholder($this->RenderText('currency value without comma'));
            $editor->SetPrefix($this->RenderText('$'));
            $editor->SetSuffix($this->RenderText('.00'));
            $editColumn = new CustomEditColumn('Approved Budget', 'approved_budget', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for budget_spent field
            //
            $editor = new TextEdit('budget_spent_edit');
            $editor->SetPlaceholder($this->RenderText('currency value without comma'));
            $editor->SetPrefix($this->RenderText('$'));
            $editor->SetSuffix($this->RenderText('.00'));
            $editColumn = new CustomEditColumn('Budget Spent', 'budget_spent', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for multi_year field
            //
            $editor = new CheckBox('multi_year_edit');
            $editColumn = new CustomEditColumn('Multi Year', 'multi_year', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for public_engagement field
            //
            $editor = new ComboBox('public_engagement_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('0 - No Public Engagement (CAO Authorization Only)', $this->RenderText('0 - No Public Engagement  (CAO Authorization Only)'));
            $editor->AddValue('1 - Inform', $this->RenderText('1 - Inform'));
            $editor->AddValue('2 - Consult', $this->RenderText('2 - Consult'));
            $editor->AddValue('3 - Involve ', $this->RenderText('3 - Involve'));
            $editor->AddValue('4 - Collaborate', $this->RenderText('4 - Collaborate'));
            $editor->AddValue('5- Empower', $this->RenderText('5 - Empower'));
            $editColumn = new CustomEditColumn('Public Engagement', 'public_engagement', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for level_of_service field
            //
            $editor = new ComboBox('level_of_service_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('Maintain existing Level Of Service', $this->RenderText('Maintain existing Level Of Service'));
            $editor->AddValue('Upgrade Level Of Service', $this->RenderText('Upgrade Level Of Service'));
            $editor->AddValue('Downgrade Level Of Service', $this->RenderText('Downgrade Level Of Service'));
            $editor->AddValue('New Level Of Service/Asset(s)', $this->RenderText('New Level Of Service/Asset(s)'));
            $editor->AddValue('Eliminate Level Of Service/Asset(s)', $this->RenderText('Eliminate Level Of Service/Asset(s)'));
            $editor->AddValue('One-Time only Project', $this->RenderText('One-Time only Project'));
            $editColumn = new CustomEditColumn('Level Of Service', 'level_of_service', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for approved field
            //
            $editor = new CheckBox('approved_edit');
            $editColumn = new CustomEditColumn('Approved by CAO', 'approved', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for progress field
            //
            $editor = new ComboBox('progress_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('0', $this->RenderText('Zero Percent'));
            $editor->AddValue('0.10', $this->RenderText('10 Percent'));
            $editor->AddValue('0.20', $this->RenderText('20 Percent'));
            $editor->AddValue('0.30', $this->RenderText('30 Percent'));
            $editor->AddValue('0.40', $this->RenderText('40 Percent'));
            $editor->AddValue('0.5', $this->RenderText('50 Percent'));
            $editor->AddValue('0.6', $this->RenderText('60 Percent'));
            $editor->AddValue('0.7', $this->RenderText('70 Percent'));
            $editor->AddValue('0.8', $this->RenderText('80 Percent'));
            $editor->AddValue('0.9', $this->RenderText('90 Percent'));
            $editor->AddValue('1', $this->RenderText('100 Percent'));
            $editColumn = new CustomEditColumn('Progress', 'progress', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for dept_id field
            //
            $editor = new ComboBox('dept_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Department', 'dept_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for programm_id field
            //
            $editor = new ComboBox('programm_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Project Type', 'programm_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for project_name field
            //
            $editor = new TextEdit('project_name_edit');
            $editColumn = new CustomEditColumn('Project Name', 'project_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^[A-Za-z0-9 ()&]+[-]*[A-Za-z0-9 ()&]*$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for date_start field
            //
            $editor = new DateTimeEdit('date_start_edit', false, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date Start', 'date_start', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue($this->RenderText('%CURRENT_DATE%'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for date_end field
            //
            $editor = new DateTimeEdit('date_end_edit', true, 'Y-m-d', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Date End', 'date_end', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue($this->RenderText('%CURRENT_DATE%'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for year field
            //
            $editor = new TextEdit('year_edit');
            $editColumn = new CustomEditColumn('Year', 'year', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue($this->RenderText('2016'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for notes field
            //
            $editor = new TextAreaEdit('notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Objectives', 'notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for priority field
            //
            $editor = new ComboBox('priority_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Priority', 'priority', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for lead field
            //
            $editor = new ComboBox('lead_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Project Lead', 'lead', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue($this->RenderText('%CURRENT_USER_ID%'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for approved_budget field
            //
            $editor = new TextEdit('approved_budget_edit');
            $editor->SetPlaceholder($this->RenderText('currency value without comma'));
            $editor->SetPrefix($this->RenderText('$'));
            $editor->SetSuffix($this->RenderText('.00'));
            $editColumn = new CustomEditColumn('Approved Budget', 'approved_budget', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue($this->RenderText('0'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for budget_spent field
            //
            $editor = new TextEdit('budget_spent_edit');
            $editor->SetPlaceholder($this->RenderText('currency value without comma'));
            $editor->SetPrefix($this->RenderText('$'));
            $editor->SetSuffix($this->RenderText('.00'));
            $editColumn = new CustomEditColumn('Budget Spent', 'budget_spent', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue($this->RenderText('0'));
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for multi_year field
            //
            $editor = new CheckBox('multi_year_edit');
            $editColumn = new CustomEditColumn('Multi Year', 'multi_year', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for public_engagement field
            //
            $editor = new ComboBox('public_engagement_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('0 - No Public Engagement (CAO Authorization Only)', $this->RenderText('0 - No Public Engagement  (CAO Authorization Only)'));
            $editor->AddValue('1 - Inform', $this->RenderText('1 - Inform'));
            $editor->AddValue('2 - Consult', $this->RenderText('2 - Consult'));
            $editor->AddValue('3 - Involve ', $this->RenderText('3 - Involve'));
            $editor->AddValue('4 - Collaborate', $this->RenderText('4 - Collaborate'));
            $editor->AddValue('5- Empower', $this->RenderText('5 - Empower'));
            $editColumn = new CustomEditColumn('Public Engagement', 'public_engagement', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for level_of_service field
            //
            $editor = new ComboBox('level_of_service_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('Maintain existing Level Of Service', $this->RenderText('Maintain existing Level Of Service'));
            $editor->AddValue('Upgrade Level Of Service', $this->RenderText('Upgrade Level Of Service'));
            $editor->AddValue('Downgrade Level Of Service', $this->RenderText('Downgrade Level Of Service'));
            $editor->AddValue('New Level Of Service/Asset(s)', $this->RenderText('New Level Of Service/Asset(s)'));
            $editor->AddValue('Eliminate Level Of Service/Asset(s)', $this->RenderText('Eliminate Level Of Service/Asset(s)'));
            $editor->AddValue('One-Time only Project', $this->RenderText('One-Time only Project'));
            $editColumn = new CustomEditColumn('Level Of Service', 'level_of_service', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for approved field
            //
            $editor = new CheckBox('approved_edit');
            $editColumn = new CustomEditColumn('Approved by CAO', 'approved', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for progress field
            //
            $editor = new ComboBox('progress_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('0', $this->RenderText('Zero Percent'));
            $editor->AddValue('0.10', $this->RenderText('10 Percent'));
            $editor->AddValue('0.20', $this->RenderText('20 Percent'));
            $editor->AddValue('0.30', $this->RenderText('30 Percent'));
            $editor->AddValue('0.40', $this->RenderText('40 Percent'));
            $editor->AddValue('0.5', $this->RenderText('50 Percent'));
            $editor->AddValue('0.6', $this->RenderText('60 Percent'));
            $editor->AddValue('0.7', $this->RenderText('70 Percent'));
            $editor->AddValue('0.8', $this->RenderText('80 Percent'));
            $editor->AddValue('0.9', $this->RenderText('90 Percent'));
            $editor->AddValue('1', $this->RenderText('100 Percent'));
            $editColumn = new CustomEditColumn('Progress', 'progress', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue($this->RenderText('0'));
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for dept_id field
            //
            $editor = new ComboBox('dept_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editColumn = new CustomEditColumn('Department', 'dept_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(true);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for programm_id field
            //
            $column = new TextViewColumn('programm_id', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetWordWrap(false);
            $grid->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $grid->AddPrintColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $grid->AddPrintColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $grid->AddPrintColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for approved field
            //
            $column = new TextViewColumn('approved', 'Approved by CAO', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $grid->AddPrintColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for dept_id field
            //
            $column = new TextViewColumn('dept_id', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for programm_id field
            //
            $column = new TextViewColumn('programm_id', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetWordWrap(false);
            $grid->AddExportColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $grid->AddExportColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $grid->AddExportColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $grid->AddExportColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for approved field
            //
            $column = new TextViewColumn('approved', 'Approved by CAO', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $grid->AddExportColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for dept_id field
            //
            $column = new TextViewColumn('dept_id', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function CreateMasterDetailRecordGridFortaskDetailEdit0projectGrid()
        {
            $result = new Grid($this, $this->dataset, 'MasterDetailRecordGridFortaskDetailEdit0project');
            $result->SetAllowDeleteSelected(false);
            $result->OnCustomDrawCell->AddListener('MasterDetailRecordGridFortaskDetailEdit0project' . '_OnCustomDrawRow', $this);
            $result->OnCustomRenderColumn->AddListener('MasterDetailRecordGridFortaskDetailEdit0project' . '_' . 'OnCustomRenderColumn', $this);
            $result->SetShowFilterBuilder(false);
            $result->SetAdvancedSearchAvailable(false);
            $result->SetFilterRowAvailable(false);
            $result->SetShowUpdateLink(false);
            $result->SetEnabledInlineEditing(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetName('master_grid');
            //
            // View column for programm_id field
            //
            $column = new TextViewColumn('programm_id', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetWordWrap(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Objectives', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('projectGrid_notes_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('projectGrid_public_engagement_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for approved field
            //
            $column = new TextViewColumn('approved', 'Approved by CAO', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for dept_id field
            //
            $column = new TextViewColumn('dept_id', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for programm_id field
            //
            $column = new TextViewColumn('programm_id', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetWordWrap(false);
            $result->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $result->AddPrintColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $result->AddPrintColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $result->AddPrintColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for approved field
            //
            $column = new TextViewColumn('approved', 'Approved by CAO', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $result->AddPrintColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for dept_id field
            //
            $column = new TextViewColumn('dept_id', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            return $result;
        }
        
        public function MasterDetailRecordGridFortaskDetailEdit0project_OnCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles)
        {
        $today = date("Y-m-d");
        if ($today > $rowData['date_end'] AND $rowData['progress'] < 1)
        $rowCellStyles['date_end'] .= 'font-size: 10pt;font-weight: bold; color: #FF0000;background-color:#F3F781;';
        elseif ($rowData['progress'] >= 1)
        $rowCellStyles['progress'] .= 'font-size: 10pt;font-weight: bold; background-color: #58FA58;';
        
        if ($rowData['budget_spent'] > $rowData['approved_budget'])
        $rowCellStyles['budget_spent'] .= 'font-size: 10pt;font-weight: bold; color:#FFFFFF; background-color: #FF0000;';
        }
        function MasterDetailRecordGridFortaskDetailEdit0project_OnCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        {
            if ($fieldName == 'progress') 
            
              {
            
                if ($fieldData >= 1)
            
                  $customText = 'Project <br /> Complete';
            else $customText = ($fieldData * 100 . '%');
                
                $handled = true;   
            
              }
        }
        function CreateMasterDetailRecordGridForproject_timeline_detailDetailEdit1projectGrid()
        {
            $result = new Grid($this, $this->dataset, 'MasterDetailRecordGridForproject_timeline_detailDetailEdit1project');
            $result->SetAllowDeleteSelected(false);
            $result->OnCustomDrawCell->AddListener('MasterDetailRecordGridForproject_timeline_detailDetailEdit1project' . '_OnCustomDrawRow', $this);
            $result->OnCustomRenderColumn->AddListener('MasterDetailRecordGridForproject_timeline_detailDetailEdit1project' . '_' . 'OnCustomRenderColumn', $this);
            $result->SetShowFilterBuilder(false);
            $result->SetAdvancedSearchAvailable(false);
            $result->SetFilterRowAvailable(false);
            $result->SetShowUpdateLink(false);
            $result->SetEnabledInlineEditing(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetName('master_grid');
            //
            // View column for programm_id field
            //
            $column = new TextViewColumn('programm_id', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetWordWrap(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Objectives', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('projectGrid_notes_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('projectGrid_public_engagement_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for approved field
            //
            $column = new TextViewColumn('approved', 'Approved by CAO', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for dept_id field
            //
            $column = new TextViewColumn('dept_id', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for programm_id field
            //
            $column = new TextViewColumn('programm_id', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetWordWrap(false);
            $result->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $result->AddPrintColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $result->AddPrintColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $result->AddPrintColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for approved field
            //
            $column = new TextViewColumn('approved', 'Approved by CAO', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $result->AddPrintColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for dept_id field
            //
            $column = new TextViewColumn('dept_id', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            return $result;
        }
        
        public function MasterDetailRecordGridForproject_timeline_detailDetailEdit1project_OnCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles)
        {
        $today = date("Y-m-d");
        if ($today > $rowData['date_end'] AND $rowData['progress'] < 1)
        $rowCellStyles['date_end'] .= 'font-size: 10pt;font-weight: bold; color: #FF0000;background-color:#F3F781;';
        elseif ($rowData['progress'] >= 1)
        $rowCellStyles['progress'] .= 'font-size: 10pt;font-weight: bold; background-color: #58FA58;';
        
        if ($rowData['budget_spent'] > $rowData['approved_budget'])
        $rowCellStyles['budget_spent'] .= 'font-size: 10pt;font-weight: bold; color:#FFFFFF; background-color: #FF0000;';
        }
        function MasterDetailRecordGridForproject_timeline_detailDetailEdit1project_OnCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        {
            if ($fieldName == 'progress') 
            
              {
            
                if ($fieldData >= 1)
            
                  $customText = 'Project <br /> Complete';
            else $customText = ($fieldData * 100 . '%');
                
                $handled = true;   
            
              }
        }
        function CreateMasterDetailRecordGridForProjectViewDetailEdit2projectGrid()
        {
            $result = new Grid($this, $this->dataset, 'MasterDetailRecordGridForProjectViewDetailEdit2project');
            $result->SetAllowDeleteSelected(false);
            $result->OnCustomDrawCell->AddListener('MasterDetailRecordGridForProjectViewDetailEdit2project' . '_OnCustomDrawRow', $this);
            $result->OnCustomRenderColumn->AddListener('MasterDetailRecordGridForProjectViewDetailEdit2project' . '_' . 'OnCustomRenderColumn', $this);
            $result->SetShowFilterBuilder(false);
            $result->SetAdvancedSearchAvailable(false);
            $result->SetFilterRowAvailable(false);
            $result->SetShowUpdateLink(false);
            $result->SetEnabledInlineEditing(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetName('master_grid');
            //
            // View column for programm_id field
            //
            $column = new TextViewColumn('programm_id', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetWordWrap(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Objectives', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('projectGrid_notes_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('projectGrid_public_engagement_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for approved field
            //
            $column = new TextViewColumn('approved', 'Approved by CAO', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for dept_id field
            //
            $column = new TextViewColumn('dept_id', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for programm_id field
            //
            $column = new TextViewColumn('programm_id', 'Project Type', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for project_name field
            //
            $column = new TextViewColumn('project_name', 'Project Name', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for date_start field
            //
            $column = new DateTimeViewColumn('date_start', 'Date Start', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for date_end field
            //
            $column = new DateTimeViewColumn('date_end', 'Date End', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for year field
            //
            $column = new TextViewColumn('year', 'Year', $this->dataset);
            $column->SetOrderable(true);
            $column->SetEscapeHTMLSpecialChars(true);
            $column->SetWordWrap(false);
            $result->AddPrintColumn($column);
            
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Notes', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for priority field
            //
            $column = new TextViewColumn('priority', 'Priority', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for lead field
            //
            $column = new TextViewColumn('lead', 'Project Lead', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for approved_budget field
            //
            $column = new TextViewColumn('approved_budget', 'Approved Budget', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $result->AddPrintColumn($column);
            
            //
            // View column for budget_spent field
            //
            $column = new TextViewColumn('budget_spent', 'Budget Spent', $this->dataset);
            $column->SetOrderable(true);
            $column = new CurrencyFormatValueViewColumnDecorator($column, 2, ',', '.', $this->RenderText('$'));
            $result->AddPrintColumn($column);
            
            //
            // View column for multi_year field
            //
            $column = new TextViewColumn('multi_year', 'Multi Year', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $result->AddPrintColumn($column);
            
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for level_of_service field
            //
            $column = new TextViewColumn('level_of_service', 'Level Of Service', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for approved field
            //
            $column = new TextViewColumn('approved', 'Approved by CAO', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues($this->RenderText('<img src="images/checked.png" alt="true">'), $this->RenderText(''));
            $result->AddPrintColumn($column);
            
            //
            // View column for progress field
            //
            $column = new TextViewColumn('progress', 'Progress', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for dept_id field
            //
            $column = new TextViewColumn('dept_id', 'Department', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            return $result;
        }
        
        public function MasterDetailRecordGridForProjectViewDetailEdit2project_OnCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles)
        {
        $today = date("Y-m-d");
        if ($today > $rowData['date_end'] AND $rowData['progress'] < 1)
        $rowCellStyles['date_end'] .= 'font-size: 10pt;font-weight: bold; color: #FF0000;background-color:#F3F781;';
        elseif ($rowData['progress'] >= 1)
        $rowCellStyles['progress'] .= 'font-size: 10pt;font-weight: bold; background-color: #58FA58;';
        
        if ($rowData['budget_spent'] > $rowData['approved_budget'])
        $rowCellStyles['budget_spent'] .= 'font-size: 10pt;font-weight: bold; color:#FFFFFF; background-color: #FF0000;';
        }
        function MasterDetailRecordGridForProjectViewDetailEdit2project_OnCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        {
            if ($fieldName == 'progress') 
            
              {
            
                if ($fieldData >= 1)
            
                  $customText = 'Project <br /> Complete';
            else $customText = ($fieldData * 100 . '%');
                
                $handled = true;   
            
              }
        }
        
        function BeforeBeginRenderPage()
        {
            if ($this->GetRecordPermission() != null)
        	       if (!$this->GetRecordPermission()->CanAllUsersViewRecords())
                     if (GetApplication()->GetCurrentUserId() == null)
                         $this->dataset->AddFieldFilter('staff_id', new IsNullFieldFilter());
                     else
        		             $this->dataset->AddFieldFilter('staff_id', new FieldFilter(GetApplication()->GetCurrentUserId(), '='));
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function projectGrid_OnGetCustomTemplate($part, $mode, &$result, &$params)
        {
        if ($part == PagePart::RecordCard && $mode == PageMode::View)
          $result = 'project_view.tpl';
        
        if ($part == PagePart::VerticalGrid && $mode == PageMode::Edit)
           $result = 'project_edit.tpl';
         
        if ($part == PagePart::VerticalGrid && $mode == PageMode::Insert)
          $result = 'project_insert.tpl';
        }
        public function projectGrid_OnCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles)
        {
        $today = date("Y-m-d");
        if ($today > $rowData['date_end'] AND $rowData['progress'] < 1)
        $rowCellStyles['date_end'] .= 'font-size: 10pt;font-weight: bold; color: #FF0000;background-color:#F3F781;';
        elseif ($rowData['progress'] >= 1)
        $rowCellStyles['progress'] .= 'font-size: 10pt;font-weight: bold; background-color: #58FA58;';
        
        if ($rowData['budget_spent'] > $rowData['approved_budget'])
        $rowCellStyles['budget_spent'] .= 'font-size: 10pt;font-weight: bold; color:#FFFFFF; background-color: #FF0000;';
        }
        function projectGrid_OnCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        {
            if ($fieldName == 'progress') 
            
              {
            
                if ($fieldData >= 1)
            
                  $customText = 'Project <br /> Complete';
            else $customText = ($fieldData * 100 . '%');
                
                $handled = true;   
            
              }
        }
        function projectGrid_OnCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
            if ($columnName == 'approved_budget')
            
            {
            
                $customText = '<strong>Total: $' . $totalValue . '</strong>';
            
                $handled = true;   
            
            }
        }
        function projectGrid_BeforeUpdateRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            $rowData['staff_id'] = $rowData['lead'];
        }
        function projectGrid_BeforeInsertRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            $rowData['staff_id'] = $rowData['lead'];
        }
        public function ShowEditButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasEditGrant($this->GetDataset());
        }
        public function ShowDeleteButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasDeleteGrant($this->GetDataset());
        }
        
        public function GetModalGridDeleteHandler() { return 'project_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
        
        private $partitions = array(1 => array('4'), 2 => array('6'), 3 => array('9'), 4 => array('10'), 5 => array('11'), 6 => array('12'), 7 => array('8'), 8 => array('13'), 9 => array('5'));
        function partition_GetPartitionsHandler(&$partitions)
        {
            $partitions[1] = 'Planning';
            $partitions[2] = 'Engineering / Public Works';
            $partitions[3] = 'Strategic Planning';
            $partitions[4] = 'Recreation and Cultural Services';
            $partitions[5] = 'Human Resources';
            $partitions[6] = 'Finance';
            $partitions[7] = 'Legislative Services';
            $partitions[8] = 'CAO';
            $partitions[9] = 'Public Works';
        }
        
        function partition_GetPartitionConditionHandler($partitionName, &$condition)
            {
                $condition = '';
                if (isset($partitionName) && isset($this->partitions[$partitionName]))
                    foreach ($this->partitions[$partitionName] as $value)
                        AddStr($condition, sprintf('(project.dept_id = %s)', $this->PrepareTextForSQL($value)), ' OR ');
            }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'projectGrid');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetInsertClientValidationScript($this->RenderText('if ( Number(fieldValues[\'budget_spent\']) > Number(fieldValues[\'approved_budget\']))
            
            {
              errorInfo.SetMessage(\'"Budget spent is greater than the Approved Budget"\');
              return true;
            }
            else if
            (fieldValues[\'date_start\'] >= fieldValues[\'date_end\'])
            {
              errorInfo.SetMessage(\'"Start date is greater than or equal to End date"\');
              return false;
            }'));
            
            $result->SetEditClientFormLoadedScript($this->RenderText('if (editors[\'approved\'].getValue() == 1) {
              editors[\'programm_id\'].setEnabled(false);
              editors[\'project_name\'].setEnabled(false);
              editors[\'date_start\'].setEnabled(false);
              editors[\'date_end\'].setEnabled(false);
              editors[\'approved_budget\'].setEnabled(false);
              editors[\'notes\'].setEnabled(false);
              editors[\'priority\'].setEnabled(false);
              editors[\'lead\'].setEnabled(false);
              editors[\'level_of_service\'].setEnabled(false);
              editors[\'multi_year\'].setEnabled(false);
              editors[\'public_engagement\'].setEnabled(false);
              editors[\'year\'].setEnabled(false); 
              editors[\'dept_id\'].setEnabled(false);
              }
            else 
            {
              editors[\'programm_id\'].setEnabled(true);
              editors[\'project_name\'].setEnabled(true);
              editors[\'date_start\'].setEnabled(true);
              editors[\'date_end\'].setEnabled(true);
              editors[\'approved_budget\'].setEnabled(true);
              editors[\'notes\'].setEnabled(true);
              editors[\'priority\'].setEnabled(true);
              editors[\'lead\'].setEnabled(true);
              editors[\'level_of_service\'].setEnabled(true);
              editors[\'multi_year\'].setEnabled(true);
              editors[\'public_engagement\'].setEnabled(true);
              editors[\'year\'].setEnabled(true); 
              editors[\'dept_id\'].setEnabled(true);
            }'));
            
            $result->SetEditClientValidationScript($this->RenderText('if ( Number(fieldValues[\'budget_spent\']) > Number(fieldValues[\'approved_budget\']))
            
            {
              errorInfo.SetMessage(\'"Budget spent is greater than the Approved Budget"\');
              return true;
            }
            else if
            (fieldValues[\'date_start\'] >= fieldValues[\'date_end\'])
            {
              errorInfo.SetMessage(\'"Start date is greater than or equal to End date"\');
              return false;
            }'));
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->OnGetCustomTemplate->AddListener('projectGrid' . '_OnGetCustomTemplate', $this);
            $result->OnCustomDrawCell->AddListener('projectGrid' . '_OnCustomDrawRow', $this);
            $result->OnCustomRenderColumn->AddListener('projectGrid' . '_' . 'OnCustomRenderColumn', $this);
            $result->OnCustomRenderTotal->AddListener('projectGrid' . '_' . 'OnCustomRenderTotal', $this);
            $result->BeforeUpdateRecord->AddListener('projectGrid' . '_' . 'BeforeUpdateRecord', $this);
            $result->BeforeInsertRecord->AddListener('projectGrid' . '_' . 'BeforeInsertRecord', $this);
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetHidePageListByDefault(false);
            $this->SetExportToExcelAvailable(true);
            $this->SetExportToWordAvailable(true);
            $this->SetExportToXmlAvailable(true);
            $this->SetExportToCsvAvailable(true);
            $this->SetExportToPdfAvailable(true);
            $this->SetPrinterFriendlyAvailable(true);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(true);
            $this->SetFilterRowAvailable(true);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
    
            //
            // Http Handlers
            //
            $pageView = new taskDetailView0projectPage($this, 'Tasks', 'Tasks', array('project_id'), GetCurrentUserGrantForDataSource('project.task'), 'UTF-8', 20, 'taskDetailEdit0project_handler');
            
            $pageView->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('project.task'));
            $handler = new PageHTTPHandler('taskDetailView0project_handler', $pageView);
            GetApplication()->RegisterHTTPHandler($handler);
            $pageEdit = new taskDetailEdit0projectPage($this, array('project_id'), array('project_id'), $this->GetForeingKeyFields(), $this->CreateMasterDetailRecordGridFortaskDetailEdit0projectGrid(), $this->dataset, GetCurrentUserGrantForDataSource('project.task'), 'UTF-8');
            
            $pageEdit->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('project.task'));
            $pageEdit->SetShortCaption('Tasks within this project');
            $pageEdit->SetHeader(GetPagesHeader());
            $pageEdit->SetFooter(GetPagesFooter());
            $pageEdit->SetCaption('Tasks');
            $pageEdit->SetHttpHandlerName('taskDetailEdit0project_handler');
            $handler = new PageHTTPHandler('taskDetailEdit0project_handler', $pageEdit);
            GetApplication()->RegisterHTTPHandler($handler);
            $pageView = new project_timeline_detailDetailView1projectPage($this, 'Tasks Gantt view', 'Tasks Gantt view', array('task_project_id'), GetCurrentUserGrantForDataSource('project.project_timeline_detail'), 'UTF-8', 20, 'project_timeline_detailDetailEdit1project_handler');
            
            $pageView->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('project.project_timeline_detail'));
            $handler = new PageHTTPHandler('project_timeline_detailDetailView1project_handler', $pageView);
            GetApplication()->RegisterHTTPHandler($handler);
            $pageEdit = new project_timeline_detailDetailEdit1projectPage($this, array('task_project_id'), array('project_id'), $this->GetForeingKeyFields(), $this->CreateMasterDetailRecordGridForproject_timeline_detailDetailEdit1projectGrid(), $this->dataset, GetCurrentUserGrantForDataSource('project.project_timeline_detail'), 'UTF-8');
            
            $pageEdit->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('project.project_timeline_detail'));
            $pageEdit->SetShortCaption('Tasks Gantt view');
            $pageEdit->SetHeader(GetPagesHeader());
            $pageEdit->SetFooter(GetPagesFooter());
            $pageEdit->SetCaption('Tasks Gantt view');
            $pageEdit->SetHttpHandlerName('project_timeline_detailDetailEdit1project_handler');
            $handler = new PageHTTPHandler('project_timeline_detailDetailEdit1project_handler', $pageEdit);
            GetApplication()->RegisterHTTPHandler($handler);
            $pageView = new ProjectViewDetailView2projectPage($this, 'Performance Charts', 'Performance Charts', array('project_id'), GetCurrentUserGrantForDataSource('project.ProjectView'), 'UTF-8', 20, 'ProjectViewDetailEdit2project_handler');
            
            $pageView->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('project.ProjectView'));
            $handler = new PageHTTPHandler('ProjectViewDetailView2project_handler', $pageView);
            GetApplication()->RegisterHTTPHandler($handler);
            $pageEdit = new ProjectViewDetailEdit2projectPage($this, array('project_id'), array('project_id'), $this->GetForeingKeyFields(), $this->CreateMasterDetailRecordGridForProjectViewDetailEdit2projectGrid(), $this->dataset, GetCurrentUserGrantForDataSource('project.ProjectView'), 'UTF-8');
            
            $pageEdit->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('project.ProjectView'));
            $pageEdit->SetShortCaption('Performance Charts');
            $pageEdit->SetHeader(GetPagesHeader());
            $pageEdit->SetFooter(GetPagesFooter());
            $pageEdit->SetCaption('Performance Charts');
            $pageEdit->SetHttpHandlerName('ProjectViewDetailEdit2project_handler');
            $handler = new PageHTTPHandler('ProjectViewDetailEdit2project_handler', $pageEdit);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Objectives', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'projectGrid_notes_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'projectGrid_public_engagement_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for notes field
            //
            $column = new TextViewColumn('notes', 'Objectives', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'projectGrid_notes_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for public_engagement field
            //
            $column = new TextViewColumn('public_engagement', 'Public Engagement', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'projectGrid_public_engagement_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
        
        public function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '<strong>Project Guidelines and References:</strong>
    <ul class="feature-list">
      <li><a href="documents/workplan_help.pdf" target="_blank">General Workplan Help</a></li>
      <li><a href="documents/ProjectDesign.pdf" target="_blank">Capital and Operating Project Design Directive</a></li>
      <li><a href="documents/PublicParticipation.pdf" target="_blank">IAP2 Spectrum of Public Participation</a></li>
    </ul>
    <hr>';
        }
    }

    SetUpUserAuthorization(GetApplication());

    try
    {
        $Page = new projectPage("project.php", "project", GetCurrentUserGrantForDataSource("project"), 'UTF-8');
        $Page->SetShortCaption('View all Projects');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Projects');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("project"));
        GetApplication()->SetEnableLessRunTimeCompile(GetEnableLessFilesRunTimeCompilation());
        GetApplication()->SetCanUserChangeOwnPassword(
            !function_exists('CanUserChangeOwnPassword') || CanUserChangeOwnPassword());
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e->getMessage());
    }
	
