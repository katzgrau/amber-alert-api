# Amber Alert API Libraries

This is a multi-language library for getting AmberAlert details by state
and case number. Right now, it only supports PHP, but that will change.

## AmberAlert API?

Right now, there isn't a natural way to "programmatically" pull AmberAlert 
data from either AmberAlert.gov or the National Center for Missing Children.
Developers who want to help the cause should really have a REST API made
available to them (or anything, I'll take XMLRPC if I have to).

The methodology of this library is to use NCMC's internal webservice call
intented for their online "poster", which contains all the missing person
information.

For a call to get missing persons by state, it first reads the publically
available RSS feed, parses out the case number, and uses that case number to
call the aforementioned webservice call.

## Example (by State)

```php
# Get the last Amber Alert for NJ

require '../AmberAlert.php';
print_r(AmberAlert::getMostRecentAlertByState('NJ', true));

```

... which outputs ...

```
stdClass Object
(
    [hasAgedPhoto] =>
    [hasExtraPhoto] => 1
    [possibleLocation] =>
    [caseNumber] => 1245612
    [orgPrefix] => NCMC
    [seqNumber] => 1
    [langId] => en_US
    [userLangId] => en_US
    [firstName] => DONTEL
    [lastName] => MICHAELS
    [middleName] =>
    [approxAge] =>
    [sex] => male
    ...
```

## License

The MIT License

Copyright (c) 2008-2015 Kenny Katzgrau katzgrau@gmail.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
