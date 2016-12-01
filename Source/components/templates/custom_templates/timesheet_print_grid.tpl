
<img src="images/bwlogo_wide.jpg"> <b>City of Courtenay Timesheet</b><p>

<table align="center" width="90%" border="0" cellpadding="3" cellspacing="3">
    <tr valign="top">



<tr valign="top">
<td bgcolor="#D3D3D3" style="width:100px">Name: </td><td><b>{$Rows[0][0]}</b></td>
    <td bgcolor="#D3D3D3" style="width:100px"> EMP# </td><td><b>{$Rows[0][7]}</b></td>
<tr valign="top">
<td bgcolor="#D3D3D3" style="width:100px">Pay Period</td><td> <b>{$Rows[0][4]}</b></td>
    
    <td bgcolor="#D3D3D3" style="width:100px">Position:</td><td> <b>{$Rows[0][6]}</b></td>


</tr></tr>

</table><p>

<table align="center" width="90%" border="0" cellpadding="3" cellspacing="2">
    <tr valign="top "bgcolor="#D3D3D3">
    <!--<td><b>{$Columns[0]->GetCaption()}</b></td>-->
    <td><b>{$Columns[1]->GetCaption()}</b></td>
    <td><b>{$Columns[2]->GetCaption()}</b></td>
    <td><b>{$Columns[3]->GetCaption()}</b></td>
    <td><b>{$Columns[5]->GetCaption()}</b></td>
    
    </tr>

{foreach item=Row from=$Rows name=RowsGrid}
    <tr valign="top">
  <!--  <td>{$Row[0]}</td>-->
    <td>{$Row[1]}</td>
    <td>{$Row[2]}</td>



<td {if $Row[3]== 'Sick Time'}
            style="color:red;"
        {else}
            style="color:black;"
        {/if} >
	{$Row[3]}
    </td>

    <td>{$Row[5]}</td>

    </tr>
{/foreach}

{if $Grid->HasTotals()}
    <tr>
   

    <td><td><td></td>
    <td>
        {if not $Totals[5].IsEmpty}
            {if $Totals[5].CustomValue}
                {$Totals[5].UserHTML}
            {else}
                {$Totals[5].Aggregate} = {$Totals[5].Value}
            {/if}
        {/if}
      </td>
    
    </tr>
{/if}



<p><br>

 <tr>
<td  bgcolor="#D3D3D3" style="width:150px"><p><br><br><b>
</p>
Employee: Sign </td><td colspan="1"><p></b>

</td><td>
<p><br><br>
</p>
<b>{$smarty.now|date_format:"%A, %B %e,%l:%M %p, %Y"}</b><br /></td></tr>
<tr>
<td bgcolor="#D3D3D3" style="width:150px"><p><br><br><b>
</p>
Supervisor: Sign </td><td colspan="1"><p></b>
</td><td>
<p><br><br>
</p>
<b>{$smarty.now|date_format:"%A, %B %e,%l:%M %p, %Y"}</b><br /></td>
</p></td></tr></table>

