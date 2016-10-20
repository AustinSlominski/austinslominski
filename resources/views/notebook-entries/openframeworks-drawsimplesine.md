## Drawing a simple, moving sine wave

Drawing a sine wave is a simple task, but at times I've had confusions because of a few differences in how it's treated in comparison to sine waves in sound.

First of all, the basic form of a sine wave as a function of time is:

```
y(t) = scalar * sin(2PI * frequency * time + phase)
```

Now to make an oscillating line, first create a series of points that *are evenly spaced*. Add this within setup():

```
for(int i = 0; i < 250; i++){
    osc_poly.addVertex(float(width/250*i),400);
}
```

If they aren't evenly spaced, the density of the wave will be uneven, which might really confuse you if you are confident you wrote the function correctly. To assure that they are evenly spaced, divide the width of the line by the number of points you want it to have. Then multiply that number by the index of your for loop. 

*Note: you might run into issues with rounding numbers, which will make your line appear shorter than what you specified.*

Now we can modulate the y values of that line. In update():

```
for(int i = 0; i < osc_poly.size(); i++){
    ofPoint & p = osc_poly[i];
    p.y = y_pos + scale*sin(2*PI*ofGetElapsedTimef()*freq+i/spread);
}
```

We are looping through the entire length of the line. Within this loop, we first grab a reference to the point at the current index. Then, we are modifying the y value. 

When I think of a sine wave in sound, I think of frequency relating to the width between the peaks and the troughs. This works fine in something continuous and moving like sound is, but we have a static, unmoving line. Our x values never move! Frequency in this context is the speed at which this wave appears to be moving by. The *width of the wave* is actually determined by the phase, or rather the amount by which we increment the phase (i/spread). The larger the number, the more dense our wave is.

Remember that we are actually applying the sine function to all of the points on our line. In reality, we have 250 sine waves here, and each of them are slightly offset, which is what gives us the appearance of the sine wave. 



