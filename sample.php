<!DOCTYPE html>
<html>
 <head>
  <title>??</title>
  <script type="text/javascript">
  </script>
<?php
$models = Array();
if (($handle = fopen("test.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($data[0] !== null) {
            array_push($models, $data);
        }
    }
    if (count($models) < 1) {
        $errors = error_get_last();
        print "<p>Error: No data in test.csv: " . $errors['message'] . "</p>\n"
        exit(2);
    }
} else {
    $errors = error_get_last();
    print "<p>Error: Couldn't open test.csv: " . $errors['message'] . "</p>\n"
    exit(1);
}

if (isset($_POST['headunit'])) {
    // print CSV and make them download it
    exit (0);
}

// The below is only if you want JavaScript plus PHP (minimize form submissions)

print "  <script type=\"text/javascript\">\n";
print "function makeRow(isTop) {\n";
print "  document.print('<tr>');\n";
print "  document.print('<td>');\n";
print "  if (isTop) {\n";
print "    document.print('<input name=\"headunit\" value=\"\" placeholder=\"Head Unit IP\">';\n");
print "  }\n";
print "  document.print('</td>');\n";
print "  document.print('<td>');\n";
print "  document.print('<input name=\"device[]\" value=\"\" placeholder=\"Head Unit IP\">';\n");
print "  document.print('</td>');\n";
print "  document.print('<td>');\n";
print "  document.print('<select name=\"devtype[]\" size=1>');\n";
for ($models as $k => $v) {
    print "  document.print('<option>" . $k[$v[0]] . "</option>');\n";
}
print "  document.print('</select>');\n";
print "  document.print('</td>');\n";
print "  document.print('<td>');\n";
print "  if (isTop) {\n";
print "    document.print('<button type=\"button\" onclick=\"makeRow(false);\">+</button>');\n";
print "  }\n";
print "  document.print('</td>');\n";
print "  document.print('</tr>');\n";
print "}\n";
print "  </script>\n";



?>
 </head>
 <body>
  <form method="post" action="">
   <table>
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
