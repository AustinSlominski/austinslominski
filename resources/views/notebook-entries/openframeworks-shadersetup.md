## Shader Setup

In the past I've been reliant on writing and testing shaders in Jitter, but I've begun to do it much more in openFrameworks, it feels more natural and portable.

To enable any kind of shader, initialize it within **ofApp.h** with `ofShader shader;`

Now, load the shader within ofApp.cpp: `shader.load("shadername")`

The name that you pass into load() is parsed from the filenames of your shader. For your vertex shader, use **shadername.vert**, and for your fragment shader, **shadername.frag**.

Now you want to enter the appropriate data into your shader.

```
shader.begin();
shader.ofSetUniformTexture("tex1", input2.getTexture(), 1);
shader.ofSetUniform1f("float_name",float myFloat);
shader.ofSetUniform1i("int_name",float myInt);
shader.ofSetUniform2f("vec2_name", vec2 myVec);
input1.draw(0,0);
shader.end();
```

As you can see above, this is when you enter your uniform variables into your shader, as well as input the textures the shader will be using. The above example is just one way of handling multiple textures. "tex0" is assumed to be what is drawn (input.draw(0,0)), but you can also explicitly set tex0.

```
shader.begin();
shader.ofSetUniformTexture("tex0", input1.getTexture(), 0);
shader.ofSetUniformTexture("tex1", input2.getTexture(), 1);
shader.ofSetUniform1f("float_name",float myFloat);
shader.ofSetUniform1i("int_name",float myInt);
shader.ofSetUniform2f("vec2_name", vec2 myVec);
input1.draw(0,0);
shader.end();
```

### Main.cpp

Your shaders still won't run without setting up the openGL window settings. Within **main.cpp**:

```
ofGLWindowSettings settings;
settings.setGLVersion(2,1);
ofCreateWindow(settings);
ofSetFullscreen(true);

ofRunApp(new ofApp());
```

This will set your openGL version to 2.1. I am currently using 2.1 exclusively because the Syphon framework is not working with openGL 3. If you would like to use openGL 3, change that to (3,2).

*Note: explain this better, I still don't really understand what's going on behind the scenes with this.*
