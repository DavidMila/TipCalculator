<script>
function isWhole(number)
{
  if ((number * 10) % 10 != 0)
  {
    return false;
  }
  return true;
}
function makeAllRangesActive()
{
  var stopHolder = "stopInterval";
  var startHolder = "startInterval";
  var count = 1;
  var countStr = String(count);
  var stopTextBox = document.getElementById(stopHolder.concat(countStr));
  var startTextBox = document.getElementById(startHolder.concat(countStr));
  while (stopTextBox != null)
  {
    //showElement();
    //console.log(stopTextBox);
    //console.log(stopHolder.concat(countStr));
    stopTextBox.disabled = false;
    try {
      startTextBox.disabled = false;
    }catch(err)
    {
      console.log("startBox doesn't exist");
    }
    count += 1;
    countStr = String(count);
    stopTextBox = document.getElementById(stopHolder.concat(countStr));
    startTextBox = document.getElementById(startHolder.concat(countStr));
  }
  var stepValue = document.getElementById("StepValue");
  stepValue.value = "0";
}
function  makeChoices()
{
  console.log("button clicked");
  var rangeType = document.getElementById("RangeTypePost");
  var choicesType = document.getElementById("RangeType").value;
  document.getElementById("number_of_choices").value = document.getElementById("Intervals").value;
  //console.log(document.getElementById("sliderQuestionForm").checked);
   
  if (document.getElementById("SingleType").checked)
  {
    console.log("making single");
    rangeType.value = "SingleType";
    makeSingleInput();
  }
  else if (document.getElementById("RangeType").checked)
  {
    console.log("making ranges");
    rangeType.value = "RangeType";
    makeIntervalInput();
  }
  var stepValue = document.getElementById("StepValue");
  stepValue.value = "1";
}
function showElement()
{
  //console.log(document.getElementById("RangesSubDiv"));
  console.log(document.getElementById("sliderQuestionForm"));
  console.log(document.getElementById("stopInterval1"));
}
function refreshIntervalContainer()
{
  var oldRangesContainer = document.getElementById("RangesSubDiv");
  var overallContainer = document.getElementById("RangesDiv");
  console.log("defaulting container should be below");
  console.log(overallContainer);
  console.log("defaulting container should be above");
  
  overallContainer.removeChild(oldRangesContainer);
  var newRangesContainer = document.createElement("myDiv");
  var alter_ranges_button = document.createElement("input");
  alter_ranges_button.setAttribute('onClick', 'javascript:makeAllRangesActive()');
  alter_ranges_button.setAttribute('type', 'button');
  alter_ranges_button.setAttribute('class', 'button');
  alter_ranges_button.setAttribute('value', 'Alter ranges'); 
  newRangesContainer.appendChild(alter_ranges_button);
  alter_ranges_button.setAttribute('style', 'float:right');
  newRangesContainer.setAttribute("id", "RangesSubDiv");
  newRangesContainer.setAttribute("style", 'width:50px');
  overallContainer.appendChild(newRangesContainer);
}

function makeSingleInput()
{
  refreshIntervalContainer();//refrsh  deletes the boxes that might have been there previously so that new boxes only can show
  var numberOfIntervals = document.getElementById("Intervals").value;//gets the number of intervals
  var min = document.getElementById("MinSlider").value;
  var max = document.getElementById("MaxSlider").value;
  var step = (max - min) / (numberOfIntervals - 1);
  var total = numberOfIntervals;
  var precision = document.getElementById("precision").value;
  var decimalPlace = Math.abs(Math.log10(precision));
  precision = parseFloat(precision);

  if (numberOfIntervals > 0 && precision == 1)
  {
    console.log("pass here 1 !");
    if (true)
    {
     console.log("pass here 2 !");
     //var currentStart = parseInt(min);
     var currentStop = parseFloat(min);
     var TrueVal = currentStop;
     while(numberOfIntervals > 0)
     {                                                                  //these create the 
        var stopHolder = "stopInterval";                                //names of textboxes
        var intervalString = String(total - numberOfIntervals + 1);     //they are called ID But i use them to create names for the text boxes
        var currentStopId = stopHolder.concat(intervalString);
        var interval_end = document.createElement("input");             //create the text box for the upper end
        interval_end.setAttribute("type", "text");                      //give it a type, value )not necessary 
        interval_end.setAttribute("value", currentStop.toFixed(decimalPlace));                        
        interval_end.setAttribute("name", currentStopId);               //and name
        interval_end.setAttribute("id", currentStopId);
        interval_end.setAttribute("style", "width:10%");  
        interval_end.disabled = true;              //and style(just width: 10%)
        var interval_div = document.getElementById("RangesSubDiv");     //
        var range_set_end_dummy = document.createElement("P");
        interval_div.appendChild(interval_end);
        interval_div.appendChild(range_set_end_dummy);
        
        numberOfIntervals -= 1;
        TrueVal += step;
        currentStop = parseInt(TrueVal);
      }
    }
  }
  else if (numberOfIntervals > 0 && precision < 1){
    console.log("pass here 3 !");
    if (true)
    {
      console.log("pass here 4 !");
     
     var currentStop = parseFloat(min);
     while(numberOfIntervals > 0)
     {                                                                  //these create the 
        var stopHolder = "stopInterval";                                //names of textboxes
        var intervalString = String(total - numberOfIntervals + 1);     //they are called ID But i use them to create names for the text boxes
        //var currentStartId = startHolder.concat(intervalString);      
        var currentStopId = stopHolder.concat(intervalString);
        var interval_end = document.createElement("input");             //create the text box for the upper end
        interval_end.setAttribute("type", "text");                      //give it a type, value )not necessary 
        interval_end.setAttribute("value", currentStop.toFixed(decimalPlace));                        
        interval_end.setAttribute("name", currentStopId);               //and name
        interval_end.setAttribute("id", currentStopId);
        interval_end.setAttribute("style", "width:10%");                //and style(just width: 10%)
        interval_end.disabled = true;    
        var interval_div = document.getElementById("RangesSubDiv");     //
        var range_set_end_dummy = document.createElement("P");
        interval_div.appendChild(interval_end);
        interval_div.appendChild(range_set_end_dummy);
        
        numberOfIntervals -= 1;
        currentStop += parseFloat(step);
      }
    }
  }
  var parentForm = document.getElementById("sliderQuestionForm");
  console.log("range should come some lines after this");
  try{
    parentForm.removeChild(numberOfIntervalsToBePosted);
  }catch(err)
  {
    console.log("we got him");
  }
  var numberOfIntervalsToBePosted = document.createElement("input");
  numberOfIntervalsToBePosted.setAttribute("name", "Ranges");
  numberOfIntervalsToBePosted.setAttribute("value", total);
  numberOfIntervalsToBePosted.setAttribute("type", "hidden");
  parentForm.appendChild(numberOfIntervalsToBePosted);
  console.log("range should be the next line");
  console.log(document.getElementsByName("Ranges")[0]);
  console.log("range should be the previous line");
}


function  makeIntervalInput()//this function makes the appropriate number of text boxes
{                
  showElement();            //based on the number put in the intervals box
  refreshIntervalContainer();//refrsh  deletes the boxes that might have been there previously so that new boxes only can show
  var numberOfIntervals = document.getElementById("Intervals").value;//gets the number of intervals
  var min = document.getElementById("MinSlider").value;
  var max = document.getElementById("MaxSlider").value;
  var step = (max - min) / numberOfIntervals;
  var total = numberOfIntervals;
  var precision = document.getElementById("precision").value;
  precision = parseFloat(precision);

  if (numberOfIntervals > 0 && precision == 1){
    if (isWhole(step))
    {
     var currentStart = parseInt(min);
     var currentStop = parseInt(min) + parseInt(~~step);
     while(numberOfIntervals > 0)
     {
        var startHolder = "startInterval";                              //these create the 
        var stopHolder = "stopInterval";                                //names of textboxes
        var intervalString = String(total - numberOfIntervals + 1);     //they are called ID But i use them to create names for the text boxes
        var currentStartId = startHolder.concat(intervalString);      
        var currentStopId = stopHolder.concat(intervalString);
        var interval_start = document.createElement("input");           //create the text box for the lower end
        interval_start.setAttribute("type", "text");                    //give it a type, value )not necessary 
        interval_start.setAttribute("value", currentStart);
        interval_start.setAttribute("name", currentStartId);            //and name
        interval_start.setAttribute("id", currentStartId);
        interval_start.setAttribute("style", "width:10%");              //and style(just width: 10%)
        interval_start.disabled =  true;    
        var interval_end = document.createElement("input");             //create the text box for the upper end
        interval_end.setAttribute("type", "text");                      //give it a type, value )not necessary 
        interval_end.setAttribute("value", currentStop);                        
        interval_end.setAttribute("name", currentStopId);               //and name
        interval_end.setAttribute("id", currentStopId);
        interval_end.setAttribute("style", "width:10%");                //and style(just width: 10%)
        interval_end.disabled =  true;    
        var interval_div = document.getElementById("RangesSubDiv");     //
        var to_indicator = document.createElement("P");
        var range_set_end_dummy = document.createElement("P");
        to_indicator.innerHTML = "-to-";
        to_indicator.setAttribute("style", "display:inline-block");
        interval_div.appendChild(interval_start);
        interval_div.appendChild(to_indicator);
        interval_div.appendChild(interval_end);
        interval_div.appendChild(range_set_end_dummy);
        numberOfIntervals -= 1;
        currentStart = currentStop + 1;
        currentStop += parseInt(~~step);
      }
    }
    else if (!isWhole(step))
    {
     var currentStart = parseInt(min);
     var currentStop = parseInt(min) + parseInt(~~step);
     while(numberOfIntervals > 1)
     {
        var startHolder = "startInterval";                              //these create the 
        var stopHolder = "stopInterval";                                //names of textboxes
        var intervalString = String(total - numberOfIntervals + 1);     //they are called ID But i use them to create names for the text boxes
        var currentStartId = startHolder.concat(intervalString);      
        var currentStopId = stopHolder.concat(intervalString);
        var interval_start = document.createElement("input");   
              //create the text box for the lower end
        interval_start.setAttribute("type", "text");                    //give it a type, value )not necessary 
        interval_start.setAttribute("value", currentStart);
        interval_start.setAttribute("id", currentStartId);
        interval_start.setAttribute("name", currentStartId);            //and name
        interval_start.setAttribute("style", "width:10%");              //and style(just width: 10%)
        interval_start.disabled = true;
        var interval_end = document.createElement("input");             //create the text box for the upper end
        interval_end.setAttribute("type", "text");                      //give it a type, value )not necessary 
        interval_end.setAttribute("value", currentStop);                        
        interval_end.setAttribute("name", currentStopId);               //and name
        interval_end.setAttribute("id", currentStopId);
        interval_end.setAttribute("style", "width:10%");                //and style(just width: 10%)
        interval_end.disabled = true;
        var interval_div = document.getElementById("RangesSubDiv");     //
        var to_indicator = document.createElement("P");
        var range_set_end_dummy = document.createElement("P");
        to_indicator.innerHTML = "-to-";
        to_indicator.setAttribute("style", "display:inline-block");
        interval_div.appendChild(interval_start);
        interval_div.appendChild(to_indicator);
        interval_div.appendChild(interval_end);
        interval_div.appendChild(range_set_end_dummy);
        
        numberOfIntervals -= 1;
        
        currentStart = currentStop + 1;
        currentStop += parseInt(~~step);
      }
        var startHolder = "startInterval";                              //these create the 
        var stopHolder = "stopInterval";                                //names of textboxes
        var intervalString = String(total - numberOfIntervals + 1);     //they are called ID But i use them to create names for the text boxes
        var currentStartId = startHolder.concat(intervalString);      
        var currentStopId = stopHolder.concat(intervalString);
        var interval_start = document.createElement("input");   
              //create the text box for the lower end
        interval_start.setAttribute("type", "text");                    //give it a type, value )not necessary 
        interval_start.setAttribute("value", currentStart);
        interval_start.setAttribute("name", currentStartId);            //and name
        interval_start.setAttribute("id", currentStartId);
        interval_start.setAttribute("style", "width:10%"); 
        interval_start.disabled = true;             //and style(just width: 10%)
        var interval_end = document.createElement("input");             //create the text box for the upper end
        interval_end.setAttribute("type", "text");                      //give it a type, value )not necessary 
        interval_end.setAttribute("value", max);                        
        interval_end.setAttribute("name", currentStopId);               //and name
        interval_end.setAttribute("id", currentStopId);
        interval_end.setAttribute("style", "width:10%"); 
        interval_end.disabled = true;               //and style(just width: 10%)
        var interval_div = document.getElementById("RangesSubDiv");     //
        var to_indicator = document.createElement("P");
        var range_set_end_dummy = document.createElement("P");
        to_indicator.innerHTML = "-to-";
        to_indicator.setAttribute("style", "display:inline-block");
        interval_div.appendChild(interval_start);
        interval_div.appendChild(to_indicator);
        interval_div.appendChild(interval_end);
        interval_div.appendChild(range_set_end_dummy);
        //console.log(document.getElementsByName("startInterval2")[0]);
        numberOfIntervals -= 1;
    }
  }
  else if(numberOfIntervals > 0 && precision < 1)
  {
    var currentStart = parseFloat(min);
    var currentStop = parseFloat(min) + parseFloat(step);
    var decimalPlace = Math.abs(Math.log10(precision));
     while(numberOfIntervals > 0)
    {
      var startHolder = "startInterval";                              //these create the 
      var stopHolder = "stopInterval";                                //names of textboxes
      var intervalString = String(total - numberOfIntervals + 1);     //they are called ID But i use them to create names for the text boxes
      var currentStartId = startHolder.concat(intervalString);      
      var currentStopId = stopHolder.concat(intervalString);
      var interval_start = document.createElement("input");   
              //create the text box for the lower end
      interval_start.setAttribute("type", "text");                    //give it a type, value )not necessary 
      interval_start.setAttribute("value", currentStart.toFixed(decimalPlace));
      interval_start.setAttribute("name", currentStartId);            //and name
      interval_start.setAttribute("id", currentStartId);
      interval_start.setAttribute("style", "width:10%");              //and style(just width: 10%)
      interval_start.disabled = true;
      var interval_end = document.createElement("input");             //create the text box for the upper end
      interval_end.setAttribute("type", "text");                      //give it a type, value )not necessary 
      interval_end.setAttribute("value", currentStop.toFixed(decimalPlace));                        
      interval_end.setAttribute("name", currentStopId);               //and name
      interval_end.setAttribute("id", currentStopId);
      interval_end.setAttribute("style", "width:10%");                //and style(just width: 10%)
      interval_end.disabled = true;
      var interval_div = document.getElementById("RangesSubDiv");     //
      var to_indicator = document.createElement("P");
      var range_set_end_dummy = document.createElement("P");
      to_indicator.innerHTML = "-to-";
      to_indicator.setAttribute("style", "display:inline-block");
      interval_div.appendChild(interval_start);
      interval_div.appendChild(to_indicator);
      interval_div.appendChild(interval_end);
      interval_div.appendChild(range_set_end_dummy);
      numberOfIntervals -= 1;
      currentStart = currentStop + precision;
      currentStop += parseFloat(step);// + precision;
    }
  }
  
  var parentForm = document.getElementById("sliderQuestionForm");
  //console.log("range should come some lines after this");
  try{
    parentForm.removeChild(numberOfIntervalsToBePosted);
  }catch(err)
  {
    console.log("we got him");
  }
  var numberOfIntervalsToBePosted = document.createElement("input");
  numberOfIntervalsToBePosted.setAttribute("name", "Ranges");
  numberOfIntervalsToBePosted.setAttribute("value", total);
  numberOfIntervalsToBePosted.setAttribute("type", "hidden");
  parentForm.appendChild(numberOfIntervalsToBePosted);
  //console.log("range should be the next line");
  //console.log(document.getElementsByName("Ranges")[0]);
  //console.log("range should be the previous line");
}

</script>