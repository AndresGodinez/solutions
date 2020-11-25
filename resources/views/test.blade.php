<html>
<head>
    <script type="text/javascript" src="{{asset('js/wp/deployJava.js')}}"></script>
    <script type="text/javascript">
        /**
         * Optionally used to deploy multiple versions of the applet for mixed
         * environments.  Oracle uses document.write(), which puts the applet at the
         * top of the page, bumping all HTML content down.
         */
        deployQZ();

        /**
         * Deploys different versions of the applet depending on Java version.
         * Useful for removing warning dialogs for Java 6.  This function is optional
         * however, if used, should replace the <applet> method.  Needed to address
         * MANIFEST.MF TrustedLibrary=true discrepency between JRE6 and JRE7.
         */
        function deployQZ() {
            let attributes = {
                id: 'qz', code: 'qz.PrintApplet.class',
                archive: 'qz-print.jar', width: 1, height: 1,
            };
            let parameters = {
                jnlp_href: {{ asset('') }} + 'qz-print_jnlp.jnlp',
                cache_option: 'plugin', disable_logging: 'false',
                initial_focus: 'false',
            };
            if (deployJava.versionCheck('1.7+') == true) {
            } else if (deployJava.versionCheck('1.6+') == true) {
                delete parameters['jnlp_href'];
            }
            deployJava.runApplet(attributes, parameters, '1.5');
        }

        /**
         * Automatically gets called when applet has loaded.
         */
        function qzReady() {
            // Setup our global qz object
            window['qz'] = document.getElementById('qz');
            let title = document.getElementById('title');
            if (qz) {
                try {
                    title.innerHTML = title.innerHTML + '';
                    document.getElementById('content').style.background = '#FFFFFF';
                } catch (err) { // LiveConnect error, display a detailed meesage
                    document.getElementById('content').style.background = '#F5A9A9';
                    alert('ERROR:  \nThe applet did not load correctly.  Communication to the ' +
                        'applet has failed, likely caused by Java Security Settings.  \n\n' +
                        'CAUSE:  \nJava 7 update 25 and higher block LiveConnect calls ' +
                        'once Oracle has marked that version as outdated, which ' +
                        'is likely the cause.  \n\nSOLUTION:  \n  1. Update Java to the latest ' +
                        'Java version \n          (or)\n  2. Lower the security ' +
                        'settings from the Java Control Panel.');
                }
            }

// AQUI AGREGUE DEFAULT IMPRESORA

            qz.findPrinter('zebra');
            // Searches for locally installed printer with "zebra" in the name
            if (qz != null) {
                qz.appendFile('https://soluciones.refaccionoriginal.com/ingreso_mat/etiqueta.txt');
                qz.print();
            }

// TERMINA

        }

        /**
         * Returns whether or not the applet is not ready to print.
         * Displays an alert if not ready.
         */
        function notReady() {
            // If applet is not loaded, display an error
            if (!isLoaded()) {
                return true;
            }
            // If a printer hasn't been selected, display a message.
            else if (!qz.getPrinter()) {
                alert('Please select a printer first by using the "Detect Printer" button.');
                return true;
            }
            return false;
        }

        /**
         * Returns is the applet is not loaded properly
         */
        function isLoaded() {
            if (!qz) {
                alert('Error:\n\n\tPrint plugin is NOT loaded!');
                return false;
            } else {
                try {
                    if (!qz.isActive()) {
                        alert('Error:\n\n\tPrint plugin is loaded but NOT active!');
                        return false;
                    }
                } catch (err) {
                    alert('Error:\n\n\tPrint plugin is NOT loaded properly!');
                    return false;
                }
            }
            return true;
        }

        /**
         * Automatically gets called when "qz.print()" is finished.
         */
        function qzDonePrinting() {
            // Alert error, if any
            if (qz.getException()) {
                alert('Error printing:\n\n\t' + qz.getException().getLocalizedMessage());
                qz.clearException();
                return;
            }
            // Alert success message
            //alert('Successfully sent print data to "' + qz.getPrinter() + '" queue.');
            window.location.href = "https://soluciones.refaccionoriginal.com/labels/etiqueta.php";

        }

        /***************************************************************************
         * Prototype function for printing raw ZPL commands
         * Usage:
         *    qz.append('^XA\n^FO50,50^ADN,36,20^FDHello World!\n^FS\n^XZ\n');
         *    qz.print();
         ***************************************************************************/
        function printZPL() {
            if (notReady()) {
                return;
            }
            // Send characters/raw commands to qz using "append"
            // This example is for ZPL.  Please adapt to your printer language
            // Hint:  Carriage Return = \r, New Line = \n, Escape Double Quotes= \"
            qz.append('^XA\n^BY4\n^FO200,20\n^BCN,200,N,N,N,A\n^FD\n');
            qz.append('3951702\n');
            qz.append('^FS\n^FO150,240\n^A0N,100,100^FWN^FH\n');
            qz.append('^FDW9100000001^FS\n');
            //qz.append('^CF5,30,30\n');
            qz.append('^FO30,350\n^A0N,50,50^FWN^FH\n');
            qz.append('^FDESPREAS SECADORA WHIRLPOOL^FS\n');
            qz.appendImage(getPath() + 'img/image.png', 'ZPLII');
            qz.append('^FS\n^XZ\n');
            qz.print();
        }

        function printZPL2() {
            if (notReady()) {
                return;
            }
            // Send characters/raw commands to qz using "append"
            // This example is for ZPL.  Please adapt to your printer language
            // Hint:  Carriage Return = \r, New Line = \n, Escape Double Quotes= \"
            qz.append('<?php echo 'HOLA';?>');
            qz.print();
        }

        /***************************************************************************
         * Prototype function for printing a text or binary file containing raw
         * print commands.
         * Usage:
         *    qz.appendFile('/path/to/file.txt');
         *    window['qzDoneAppending'] = function() { qz.print(); };
         ***************************************************************************/
        function printFile(file) {
            if (notReady()) {
                return;
            }

            // Append raw or binary text file containing raw print commands
            //qz.appendFile(getPath() + "misc/" + file);
            qz.appendFile(getPath() + file);

            // Automatically gets called when "qz.appendFile()" is finished.
            window['qzDoneAppending'] = function() {
                // Tell the applet to print.
                qz.print();

                // Remove reference to this function
                window['qzDoneAppending'] = null;

            };

        }

        /***************************************************************************
         ****************************************************************************
         * *                          HELPER FUNCTIONS                             **
         ****************************************************************************
         ***************************************************************************/

        /***************************************************************************
         * Gets the current url's path, such as http://site.com/example/dist/
         ***************************************************************************/
        function getPath() {
            let path = window.location.href;
            return path.substring(0, path.lastIndexOf('/')) + '/';
        }


    </script>

    <script type="text/javascript" src="{{asset('js/wp/jquery-1.10.2.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/wp/html2canvas.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/wp/jquery.plugin.html2canvas.js')}}"></script>


<body id="content" bgcolor="#F0F0F0">
<div style="position:absolute;top:0;left:5;">
    <h1 id="title"></h1></div>
<br/><br/><br/>
</body>
<canvas id="hidden_screenshot" style="display:none;"></canvas>

<?php

    $etiqueta = "
^XA^BY4^FO70,20^BCN,200,N,N,N,A^FDHOLAAAA^FS^FO70,240^A0N,100,100^FWN^FH
^FDHOLAAAA
^FS^FO70,330
^A0N,50,50
^FWN^FH
^FDHOLAAAA^FS

^FO70,380
^A0N,30,30
^FWN^FH
^FDFecha: HOLAAAA
^FS


^XZ\n";


$myfile = fopen("etiqueta.txt", "w") or die("Unable to open file!");
$txt = $etiqueta;
fwrite($myfile, $txt);
fclose($myfile);
?>

</body>
<canvas id="hidden_screenshot" style="display:none;"></canvas>

</html>
