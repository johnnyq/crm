//----------------------------------------------------------------------------
//
//  $Id: PreviewAndPrintLabel.js 11419 2010-04-07 21:18:22Z vbuzuev $
//
// Project -------------------------------------------------------------------
//
//  DYMO Label Framework
//
// Content -------------------------------------------------------------------
//
//  DYMO Label Framework JavaScript Library Samples: Preview and Print label
//
//----------------------------------------------------------------------------
//
//  Copyright (c), 2010, Sanford, L.P. All Rights Reserved.
//
//----------------------------------------------------------------------------

 // register onload event


 var thissystemID = 0;
 var thistype = "";

    function previewAndPrintstart(typeID,systemID)
    {

           thissystemID = systemID;
           thistype = typeID;
		    if (window.addEventListener)
		        window.addEventListener("load", previewAndPrint, false);
		    else if (window.attachEvent)
		        window.attachEvent("onload", previewAndPrint);
		    else
		        window.onload = previewAndPrint;
    }
 // stores loaded label info
    var label;
    var thisurl = window.location.hostname +  location.pathname.substring(0,location.pathname.lastIndexOf('/')+1);
    //alert(thisurl);
    // called when the document completly loaded
    function previewAndPrint(typeID,systemID)
    {

           thissystemID = systemID;
           thistype = typeID;
        var labelFile = document.getElementById('labelFile');
        var printersSelect = document.getElementById('printersSelect');
        var printButton = document.getElementById('printButton');


        // initialize controls
        printButton.disabled = true;
        getPreview();
        // Generates label preview and updates corresponend <img> element
        // Note: this does not work in IE 6 & 7 because they don't support data urls
        // if you want previews in IE 6 & 7 you have to do it on the server side
        function updatePreview()
        {
            if (!label)
                return;

            var pngData = label.render();

            var labelImage = document.getElementById('labelImage');
            document.getElementById('labelImage').innerHTML = "Loading";
            labelImage.src = "data:image/png;base64," + pngData;
            //alert("done");
        }

        // loads all supported printers into a combo box
        function loadPrinters()
        {
            var printers = dymo.label.framework.getPrinters();
            if (printers.length == 0)
            {
                alert("No DYMO printers are installed. Install DYMO printers.");
                return;
            }

            for (var i = 0; i < printers.length; i++)
            {
                var printerName = printers[i].name;

                var option = document.createElement('option');
                option.value = printerName;
                option.appendChild(document.createTextNode(printerName));
                printersSelect.appendChild(option);
            }
        }

        // returns current address on the label
        function getAddress()
        {
            if (!label || label.getAddressObjectCount() == 0)
                return "";

            return label.getAddressText(0);
        }

        // set current address on the label
        function setAddress(address)
        {
            if (!label || label.getAddressObjectCount() == 0)
                return;

            return label.setAddressText(0, address);
        }

        // loads label file thwn user selects it in file open dialog
        function getPreview()
        {
                  //alert("http://"+thisurl+"dymo/php_print_label_"+thistype+".php?print_id="+thissystemID);
                  label = dymo.label.framework.openLabelFile("http://"+thisurl+"/dymo_print_label_design_"+thistype+".php?print_id="+thissystemID);

            // check that label has an address object


            updatePreview();
            printButton.disabled = false;
        };

        // updates address on the label when user types in textarea field


        // prints the label
        printButton.onclick = function()
        {
            try
            {
                if (!label)
                {
                    alert("Load label before printing");
                    return;
                }

                //alert(printersSelect.value);
                label.print(printersSelect.value);
                //label.print("unknown printer");
            }
            catch(e)
            {
                alert(e.message || e);
            }
        }

        // load printers list on startup
        loadPrinters();
    };



