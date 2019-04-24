/**
 * Rule textbox
 * @author: TP
 * @version: 0.02
 *
 *
 *Example
 *
 *<table>
 *  <tr><td>Integer (both positive and negative):</td><td><input id="intTextBox"></td></tr>
 *  <tr><td>Integer (positive only):</td><td><input id="uintTextBox"></td></tr>
 *  <tr><td>Integer (positive and &lt;= 500):</td><td><input id="intLimitTextBox"></td></tr>
 *  <tr><td>Floating point (use . or , as decimal separator):</td><td><input id="floatTextBox"></td></tr>
 *  <tr><td>Currency (at most two decimal places):</td><td><input id="currencyTextBox"></td></tr>
 *  <tr><td>Hexadecimal:</td><td><input id="hexTextBox"></td></tr>
 *</table>
 */

 function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  });
}


// Install input filters.
setInputFilter(document.getElementById("intTextBox"), function(value) {
 	return /^-?\d*$/.test(value); 
});

setInputFilter(document.getElementById("uintTextBox"), function(value) {
 	return /^\d*$/.test(value); 
});

setInputFilter(document.getElementById("intLimitTextBox"), function(value) {
 	return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500); 
});

setInputFilter(document.getElementById("floatTextBox"), function(value) {
 	return /^-?\d*[.,]?\d*$/.test(value); 
});

setInputFilter(document.getElementById("floatTextBoxnc"), function(value) {
 	return /^-?\d*[.]?\d*$/.test(value); 
});

setInputFilter(document.getElementById("currencyTextBox"), function(value) {
 	return /^-?\d*[.,]?\d{0,2}$/.test(value); 
});

setInputFilter(document.getElementById("currencyTextBoxnc"), function(value) {
 	return /^-?\d*[.]?\d{0,2}$/.test(value); 
});

setInputFilter(document.getElementById("hexTextBox"), function(value) {
 	return /^[0-9a-f]*$/i.test(value); 
});