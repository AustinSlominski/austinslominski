## [groove~]

*"The groove~ object is a variable-rate, looping, sample-playback object which references the audio information stored in a buffer~ object with the same name."*

The groove object is the foundation of most audio looping mechanisms in Max.

### Basic Usage

**[groove~ {symbol buffer-name} {int number-of-channels}]**

![alt-text]({{ asset('img/note-img/groove-1.png') }})

Above is a basic example of how groove will be used. In this example we have a 2-channel buffer, "my-sound", that is being referenced by our groove~. Our groove~ is sending two values, the output of our first and second channels.

Groove accepts a signal to control playback and speed. Send a float that represents the speed of your sound (1=normal,0=stopped) into a sig~, and then to the first inlet of groove~.
			
### Loop Sync
			
Sometimes you want to use the loop as a trigger for something else. To do this, use the final outlet. The last outlet will send a signal from 0.0 - 1.0, with 1.0 being the end of the loop. You might want to use this signal as it is, or you might want to trigger a bang.

To trigger a bang at the beginning or end of a loop, -- note to self: pick this apart and finish section --

![Image demonstrating loop sync with the groove~ object in MaxMSP](../img/note-img/groove-2.png)

### Smoothing a Loop

You might notice a clicking sound when your loop is running. This is because the end of your loop immediately jumps to the beginning, causing a sudden change in volume. There are a few different ways we can approach smoothing this out.

A typical approach might be using something like a line~ object. Another method I just [recently came across][1] is using the trapezoid~ object to smooth the beginning and end of the sample. The execution is simple:

![alt-text](../img/note-img/groove-3.png)

The float labeled "Smoothness" sets the speed at which it ramps up and ramps down. You can of course set these individually if you have a sample that needs precise tweaking.

[1]: https://cycling74.com/forums/topic/groove-loop-with-no-clicks/#.V_1HeKOZN0w