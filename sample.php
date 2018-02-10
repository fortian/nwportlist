<!DOCTYPE html>
<html>
 <head>
  <title>??</title>
<?php
$msg = null;
$models = array();
if (($handle = fopen("test.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($data[0] !== null) {
            array_push($models, $data);
        }
    }
    if (count($models) < 1) {
        $errors = error_get_last();
        $msg = "<p>Error: No data in test.csv: " . $errors['message'] . "</p>\n"
    }
} else {
    $errors = error_get_last();
    $msg = "<p>Error: Couldn't open test.csv: " . $errors['message'] . "</p>\n"
}

if (!isset($msg) && isset($_POST['headunit'])) {
    // print CSV and make them download it
    exit (0);
}

// The below is only if you want JavaScript plus PHP (minimize form submissions)

if (!isset($msg)) {
    print <<< END1
  <script type="text/javascript">
function makeRow(isTop) {
    var table, tr, td, input, select, option, button, models, i;

    models = [
END1
    foreach ($models as $v) {
        // Stomp on \ and ' in the name.  Don't use those in names.
        $x = str_replace(array("\\", "'"), '', $v[0]);
        print "        '" . $x . "',\n";
    }
    print <<< END2
    ];

    table = document.getElementById('maintbl');
    if (table != null) {
        tr = table.createRow(); // Automatically gets added to the table.
        td = tr.createCell(); // Automatically gets added to the row.

        if (isTop) {
            input = document.createElement('input');
            input.name = 'headunit';
            input.placeholder = 'Head Unit IP';
            td.appendChild(input);
        }

        td = tr.createCell();
        input = document.createElement('input');
        input.name = 'deviceip[]';
        input.placeholder = 'Device IP';
        td.appendChild(input);

        td = tr.createCell();
        select = document.createElement('select');
        select.name = 'devicetype[]';
        foreach (i in models) {
            option = document.createElement('option');
            option.appendChild(document.createTextNode(models[i]));
            select.appendChild(option);
        }
        td.appendChild(select);

        td = tr.createCell();
        if (isTop) {
            button = document.createElement('button');
            button.type = 'button';
            button.appendChild(document.createTextNode('+'));
            button.onclick = 'makeRow(false);';
            td.appendChild(button);
        }
    }
}
END2
?>
 </head>
 <body>
  <form method="post" action="">
   <table id="maintbl">
    <tr>
     <th>Head Unit</th>
     <th>Device</th>
     <th>Device Type</th>
    </tr>
    <script type="text/javascript">
makeRow(true);
    </script>
   </table>
   <input type="submit">
  </form>
 </body>
</html>
