<td class="middel">
	<div class="box">
		
		<div class="boxtitle" style = 'text-align: center;'>Параметры поиска</div></td>
		<tr>
        <h1 style="text-align: center;"><font color="1168a6"><font size="6"><font face="Tahoma, Geneva, sans-serif"> </font></font></font></h1>
        
        <form id = 'search-form'>
        <p style="text-align: center;"><input style="text-align: center; color: #FFF;" maxlength="50" id = 'find-text' name = 'find-text' size="40" type="search" placeholder = "Введите ник игрока или любой текст" /></p>
        
        <center>
            
        <select id = 'Type' name = 'Type'>
            <option disabled selected>ТИП:</option>
            <option value = '1'>Везде</option>
        	<option value = '2'>Админ действия</option>
        	<option value = '3'>Действия с бизнесами</option>
        	<option value = '4'>Действия с домами</option>
        	<option value = '5'>Действия с машинами</option>
        </select>
        
        <br />
        <br />
        
        <select id = 'Showed' name = 'Showed'>
            <option disabled selected>Отображение</option>
            <option value = '1'>Новые вверху / Старые внизу</option>
        	<option value = '2'>Старые вверху / Новые внизу</option>
        </select>
       
        </center>
        
        <br />
        
        <center>
            <input type="date" id = 'dateInput' name = 'dateInput'>
            <input type="time" id = 'timeInput' name = 'timeInput'>
        </center>
        
        <br />
        
        <center>
            
            <p style="text-align: center;">
                <input style="text-align: center; color: #FFF;" maxlength="10" id = 'search_0' name = 'search_0' min = "0" type = "number" placeholder = "(№) Строка от" />
                <input style="text-align: center; color: #FFF;" maxlength="10" id = 'search_1' name = 'search_1' min = "0" type = "number" value = '100' placeholder = "(№) Строка до" />
            </p>
            
        </center>
        
        
        <br />
        <center>
            
        <button class = 'c-button'>Загрузить актуальную информацию</button></center><tbody>
	
	    </form>
	
	</div>
</div>

<br />
<br />

<td class="middel">
	<div class="box">
		<div class="boxtitle">Полученная информация:</div></td>
		<br />
		    <finder></finder>
        <br />
	</div>
</div>


<script src = '../js/sweetalert2.all.min.js' type="text/javascript"></script>
<script src = '../js/dynamicupdate_2$.js' type="text/javascript"></script>