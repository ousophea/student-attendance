function addInputs(theInput){
	
  var table = document.createElement('table');
      table.id = 'hMembers';
  var hMembers = document.getElementById('hMembers');
   if(hMembers)theInput.parentNode.removeChild(hMembers);

   if(theInput.value.match(/^\d+$/)){
    var tbody = document.createElement('tbody');
     for(var i=0; i<theInput.value; i++){
         var row   = document.createElement('tr');
         var cell  = document.createElement('td');
         var num   = document.createTextNode((i+1)+':');
             cell.appendChild(num);
             row.appendChild(cell);
             tbody.appendChild(row);

         var cell  = document.createElement('td');
         var name  = document.createTextNode('Start Date:');
         var input = document.createElement('input');
             input.name = 'txt_tersdate'+(i+1);
			 input.className='datePicker';
			 input.type='text';
			 //input.innerHTML="onclick='test()'";
			 //input.onclick='test()';
             cell.appendChild(name);
             cell.appendChild(input);
             row.appendChild(cell);
             tbody.appendChild(row);

         var cell  = document.createElement('td');
         var name1   = document.createTextNode('End Date:');
         var input = document.createElement('input');
             input.name = 'txt_teredate'+(i+1);
			 input.className='datePicker';
			 input.type='text';
			 
			 //input.addEventListener('onclick',test(), true);
			 //input.attachEvent('onclick', test());
             cell.appendChild(name1);
             cell.appendChild(input);
			 //cell.attachEvent('onclick',test());
             row.appendChild(cell);
             tbody.appendChild(row);
	}       
	table.appendChild(tbody);
    theInput.parentNode.insertBefore(table,theInput.nextSibling);
   }        

   else{ alert('Please enter only numbers in this field!');
         theInput.value = '';
         theInput.focus();
   }            
 }
 function test(){
	 alert(1);
}