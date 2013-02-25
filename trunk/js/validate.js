function isDate(txtDate) {
    var objDate,  // date object initialized from the txtDate string
        mSeconds, // txtDate in milliseconds
        day,      // day
        month,    // month
        year;     // year
    // date length should be 10 characters (no more no less)
    if (txtDate.length !== 10) {
        return false;
    }
    // third and sixth character should be '/'
    if (txtDate.substring(4, 5) !== '-' || txtDate.substring(7, 8) !== '-') {
		//alert(txtDate.substring(4, 5)+" "+txtDate.substring(7,8));
        return false;
    }
    // extract month, day and year from the txtDate (expected format is mm/dd/yyyy)
    // subtraction will cast variables to integer implicitly (needed
    // for !== comparing)
    year = txtDate.substring(0, 4) - 0; // because months in JS start from 0
    month = txtDate.substring(5, 7) - 1;
    day = txtDate.substring(8, 10) - 0;
    // test year range
    if (year < 1000 || year > 3000) {
        return false;
    }
    // convert txtDate to milliseconds
    mSeconds = (new Date(year, month, day)).getTime();
    // initialize Date() object from calculated milliseconds
    objDate = new Date();
    objDate.setTime(mSeconds);
    // compare input date and parts from Date() object
    // if difference exists then date isn't valid
    if (objDate.getFullYear() !== year ||
        objDate.getMonth() !== month ||
        objDate.getDate() !== day) {
        return false;
    }
    // otherwise return true
    return true;
}
function checkDate(){
    // define date string to test
    var txtDate = document.getElementById('datePicker').value;
    var txtDate1 = document.getElementById('datePicker1').value;
    // check date and print message
    if (isDate(txtDate) && isDate(txtDate1)) {
        //alert('OK');
		return true;
    }
    else {
        alert('Invalid date format!');
		return false;
    }
}