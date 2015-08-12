# Description

A PHP class for interacting with an Orange TV decoder's "API". With this class you can currently retrieve system info, change the volume, turn the box on or off, change channel...

# Requirements

* php5
* php5-curl

# Usage

### Create an object

The class constructor requires the IP of the Orange TV to be provided (you can find it by scanning your local network, or by displaying the IP on the screen in the settings of the box.)  

    require('OrangeTv.class.php');
    $orangeTv = new OrangeTv("192.168.1.20");

You can also provide a port, but by default it is `8080`:

    $orangeTv = new OrangeTv("192.168.1.20", 9090);

### Get System Info

    var_dump($orangeTv->getSystemInfo());

Which returns something like this:

    object(stdClass)#4 (11) {
      ["timeShiftingState"] => string(1) "0"
      ["playedMediaType"] => string(4) "LIVE"
      ["playedMediaState"] => string(4) "PLAY"
      ["playedMediaId"] => string(3) "195"
      ["playedMediaContextId"] => string(1) "1"
      ["playedMediaPosition"] => string(2) "NA"
      ["osdContext"] => string(4) "LIVE"
      ["macAddress"] => string(17) "D0:84:B0:87:75:52"
      ["wolSupport"] => string(1) "0"
      ["friendlyName"] => string(6) "OrangeTV"
      ["activeStandbyState"] => string(1) "0"
    }

### Simulate remote key presses

    $orangeTv->sendKeyPress(5);

This will return `TRUE` or `FALSE`.

You can also simulate long key presses:

    // Start long key press
    $orangeTv->sendKeyPress('VOL+', 1);
    // Hold key down for 2 seconds
    sleep(2);
    // End long key press
    $orangeTv->sendKeyPress('VOL-', 2);

# Key press modes

* `0`: Single press
* `1`: Start long press
* `2`: End long press

# Available key presses

Here is the list of key presses you can send to the Orange TV:

* `0`: Button 0
* `1`: Button 1
* `2`: Button 2
* `3`: Button 3
* `4`: Button 4
* `5`: Button 5
* `6`: Button 6
* `7`: Button 7
* `8`: Button 8
* `9`: Button 9
* `ONOFF`: On / Off button
* `CH+`: Channel up button
* `CH-`: Channel down button
* `VOL+`: Volume up button
* `VOL-`: Volume down button
* `MUTE`: Mute button
* `UP`: Up button
* `DOWN`: Down button
* `LEFT`: Left button
* `RIGHT`: Right button
* `OK`: Ok button
* `BACK`: Back button
* `MENU`: Menu button
* `PLAYPAUSE`: Play / Pause button
* `RWD`: Rewind button
* `FWD`: Forward button
* `REC`: Record button
* `VOD`: Video on demand button

# Disclaimer

This is in no way affiliated or endorsed by Orange SA.
