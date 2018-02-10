# nwportlist
Generate CSV for NetWitness Well Known Ports

Alternatives:

If you don't want to commingle JavaScript and PHP, you could do the
following:

1. First time through, the table has one row plus header:

```html
<table>
 <tr>
  <th>Head Unit IP</th>
  <th>Device IP</th>
  <th>Device Type</th>
  <th>Add/Save</th>
 </tr>
 <tr>
  <td><input name="headunit" value=""></td>
  <td><input name="deviceip[]" value=""><td>
  <td>
   <select name="devicetype[]">
    <option>Model 1</option>
    <option>Model 2</option>
    <option>Model 3</option>
    <!-- and so on -->
   </select>
  </td>
  <td>
   <input type="submit" name="add" value="+">
   <input type="submit" name="save" value="Save">
  </td>
 </tr>
</table>
```

2. The user hits the plus button.
3. The server validates the inputs
  - If they're bad, kick it back with an error message, and go back to 1.  If you're feeling nice, pre-fill-in the fields and mark the one that is wrong.
  - If they're good, go on to 4.  Let's assume they entered, respectively, `10.10.10.10`, `10.11.12.13`, and `Model 2`.
4. The server replies with the following:

```html
<table>
 <tr>
  <th>Head Unit IP</th>
  <th>Device IP</th>
  <th>Device Type</th>
  <th>Add/Save</th>
 </tr>
 <tr>
  <td><input name="headunit" disabled value="10.10.10.10"></td>
  <td><input name="deviceip[]" disabled value="10.11.12.13"><td>
  <td>
   <select disabled name="devicetype[]">
    <option selected>Model 2</option>
    <!-- note lack of other options -->
   </select>
  </td>
  <td><!-- Note lack of + and Save buttons. -->
 </tr>
 <tr>
  <td>10.10.10.10</td><!-- This is the first IP they entered last time. -->
  <!-- Otherwise, this is basically the same as the old first data row. -->
  <td><input name="deviceip[]" value=""><td>
  <td>
   <select name="devicetype[]">
    <option>Model 1</option>
    <option>Model 2</option>
    <option>Model 3</option>
    <!-- and so on -->
   </select>
  </td>
  <td>
   <input type="submit" name="add" value="+">
   <input type="submit" name="save" value="Save">
  </td>
 </tr>
</table>
```

5. Repeat from 3, as needed, adding extra rows with disabled inputs as needed.
6. Eventually, they hit the `Save` button.
7. Now, the server gronkulates through the CSV, looking for the correct ports, generates the appropriate CSV, encourages their browser to download it, and sends them back to the original pace, clean of all inputs.
