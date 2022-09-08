function generateTable()
{
    var numberOfRooms = 5;
    var timeSlots = 9;

    var myTable = document.getElementById("generatedTable");
    var tBody = document.createElement("TBODY");
    var tData = document.createElement("TD");

    for (var i = 1; i <= numberOfRooms; i++)
    {
        var tBody = document.createElement("TBODY");
        var tRow = document.createElement("TR");
        
        var tData = document.createElement("TD");
        tData.setAttribute("class", "room");
        var textData = document.createTextNode("Room " + i);
        tData.appendChild(textData);
        tRow.appendChild(tData);

        for (var j = 0; j < timeSlots; j++)
        {
            tData = document.createElement("TD");
            tData.addEventListener("click", function() { cellClick(this); });
            tData.addEventListener("mouseover", function() { mouseOver(this); });
            tData.addEventListener("mouseout", function() { mouseOut(this); });
            
            tRow.appendChild(tData);
        }

        myTable.appendChild(tRow);

    }
}

function cellClick(cell)
{
    var check = confirm("Confirm booking?");

    if (check == true)
    {
        alert("Booking confirmed!");
    }
    else
    {
        alert("Booking cancelled!");
    }
}

function mouseOver(cell)
{
    cell.style.backgroundColor = "#91908d";
}

function mouseOut(cell)
{
    cell.style.backgroundColor = "#bcbfc2";
}




