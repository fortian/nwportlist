# nwportlist
Generate CSV for NetWitness Well Known Ports

Alternatives:

If you don't want to commingle JavaScript and PHP, you could do the
following:

1. First time through, the table has one row plus header:

Head Unit IP | Device IP | Device Type | Add
-------------|-----------|-------------|----
<input placeholder="Head Unit IP"> | <input placeholder="Device IP"> |
<select size=1><option>Device Type</option></select | <button>+</button>


    [ Head Unit IP ]   [ Device IP ]   [ 
- The `[ + ]` button submits the form to the server.
- The server replies with a table made out of the following rows
