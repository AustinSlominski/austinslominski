## Frame by Frame Rendering with ofVideoPlayer

There are a lot of situations in which running everything realtime is not necessary. I've been looking for more methods to do this, but here is what is working for me right now.

Once you have your videos loaded and everything, usually you will call ofVideoPlayer::update() within ofApp::update(). If you want to force it to go frame-by-frame, do this:

```
video.nextFrame();
video.update();
```

As an alternative,[memo suggests using this:][1]

```
video.setPosition(currentFrame * 1.0f/video.getTotalNumFrames());
currentFrame++;
```

Following this, you want to save an image. You can use ofSaveImage() for this.

```
if(capture_frames){
	ofPixels tmpPixels;
	vid.getPixels( tmpPixels );
	ofSaveImage( tmpPixels, ofToString(ofGetFrameNum())+".png" );
}
```

I use 'capture_frames' as a bool to toggle the recording on and off, which you can just go ahead and bind to whatever event you want.

### What about video format?

I had a lot of issues getting the right video format. Sometimes you will get skipped frames, or the nextFrame() command doesn't work how you want it to. I've found that h.264 can be somewhat problematic. What I have done is format my videos as Apple Prores 422, and added a keyframe for every frame. You can achieve this with the following ffmpeg command through the terminal. If you don't have ffmpeg, get it [here:][2]

```
ffmpeg -y -i input.mov -keyint_min 1 -c:v prores -profile:v 2 output.mov
```

[1]: https://forum.openframeworks.cc/t/processing-a-qt-video-frame-by-frame/2547/5
[2]: https://ffmpeg.org