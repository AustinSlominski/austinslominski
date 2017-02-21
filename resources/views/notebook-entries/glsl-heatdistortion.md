## Creating a heat distortion effect

I've gotten heat distortion to work in the past through Jitter and GLSL, but the implementation was messy. It used a still image of noise to offset the original image, which is in and of itself fine, but it would *drag* the image across, and then back in a sine function, which really lent to an unrealistic appearance. 

Since then I've worked to rebuild it for openFrameworks and openGL 2.

### Writing the shader

#### **Vertex**

The vertex shader for this is entirely standard. You might notice the shader preprocessor is **#version 120**. This is because I am currently only implementing things in openGL 2.1. I use the syphon library to record and share video between programs, and currently it isn't supporting openGL 3. Okay, onward.

```
#version 120

varying vec2 texCoordVarying;

void main(){
    texCoordVarying = gl_MultiTexCoord0.xy;

    gl_Position = ftransform();
}
```

We need to access the texture coordinates and we need to tell openGL where the position of the current vertex is, and that's what we are doing above.


#### **Fragment**

The fragment shader is very simple. We take in two textures, tex0 and tex1, and accept a uniform variable, strength. Our texture coordinate is being input with texCoordVarying.

tex0 is our source image, the one we see *through* the heat distortion. tex1 is the distortion texture, the black and white image we are using to manipulate tex0.

*note - I don't have a confident sense of sampler2D vs sampler2DRect. I know that sampler2D is square and the other is rectangular, but that's about where my knowledge stops. Currently I have been assuming sampler2D, particularly if I have normalized coordinates enabled.*

```
#version 120

uniform sampler2D tex0;
uniform sampler2D tex1;

uniform float strength;

varying vec2 texCoordVarying;

void main()
{
    vec2 uv = texCoordVarying;
    vec4 distortion = texture2D(tex1, uv);
    
    uv.x = uv.x + distortion.x / strength;
    uv.y = uv.y + distortion.y / strength;
    
    gl_FragColor = texture2D(tex0,uv);
}
```

Within main(), texCoordVarying is made into the variable "uv". Next we grab the current distortion texture. Now we skew the uv coordinates by the grayscale value of the distortion texture. With this, the current pixel of tex0 is offset by the grayscale value of tex1. This offset is scaled by the uniform "strength". 

What do we want to distort our source texture with though? There are a lot of ways to play with this, really any grayscale texture or noise will work. I'll walk through the implementation of a few different methods below.

### Using FBM for distortion

This was my first though, primarily because I was just recently playing with FBM so a shader was easily available for it. This is okay, but not extremely effective. It creates great waves, but placed over an image, it doesn't really resemble heat distortion. You are much better off using plain noise for your texture. 

### Using text for distortion

This was a bit of a shot in the dark. It's not a very striking effect, I guess it could be used in some circumstances for some stylized text, but it's pretty plain and very hard to read. When very high contrast black and white image is used as the distortion, you don't get much variation, you get basically a mask with an offset. You don't even get warping. 

### Using other videos for distortion

Really wild, violent effect. Below, I used the video of the street as both the source AND the distortion layer.

