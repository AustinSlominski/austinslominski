## Matrices

*http://www.opengl-tutorial.org/beginners-tutorials/tutorial-3-matrices/*

Matrices are arrays of numbers. When dealing with graphics, you deal a lot with matrices, for storing rgba values, storing positions, directions, and also for defining transformations, etc.

When working in 3D, you might assume you have x, y, and z values. There is one more value, w, which labels the vector as either being a position or a direction.

If w == 1, the vector is a position in space.
If w == 0, the vector is a direction.

We often have to transform vertices in 3D, and for that, we use 4x4 matrices that store these vectors.

### Identity Matrix

The identity matrix appears like this:

```
[1 0 0 0]
[0 1 0 0]
[0 0 1 0]
[0 0 0 1]
```

The importance of this matrix is that anything multiplied by this matrix, equals itself.

### Model, View, and Projection Matrices

In 3D graphics, there are different contexts that you think of coordinates. When you are dealing with one object, you think of it with it's own center.

The *Model Space* is this, when the coordinate system is based on the center of the object.

This isn't the only space, we also think of the world, and it's center. This is *World Space*, and the objects in the world are all located based on our relationship with the center of this space.

Finally, our sight has a center, which we consider within *Camera Space*. This is what makes something appear to be in the upper left of a frame, and it is also what gives our world depth and perspective.

These are important concepts to remember, and this is also when some important transformation matrices come into play.

### The Model Matrix

Say we had an object, and we translate (I.E. moved) it, rotated it, and scaled it, causing it to leave that point in space that was once it's center. This transformation puts our object in *World Space*. The object's center is not the center of the world anymore, we think of the object in the relationship to it's surroundings. The *Model Matrix* is a transformation matrix that positions our object in space.

To sum it up, we have our *Model Coordinates*, which are transformed by the *Model Matrix*, resulting in new *World Coordinates*.

### The View Matrix

If we have a viewer in this world, we have to begin thinking of the location of everything in that world as relative to their viewpoint. In 3D graphics, the world rotates and moves AROUND the viewer. In *Camera Space*, our camera is the origin point, and the *View Matrix* is the transformation matrix that allows us to move our viewpoint around through space.

To sum it up again, we have our *Model Coordinates*, which are transformed by the *Model Matrix*, resulting in new *World Coordinates*, and then we transform these *World Coordinates* using the *View Matrix*, which results in our new *Camera Coordinates*.

And finally,

### The Projection Matrix

Our view point is not two dimensional. The size of things around us is determined by our distance from them, and this is what the *Projection Matrix* allows us to do. Once we are in camera space, a transformation by the *Projection Matrix* will distort the objects within space to give us perspective, resulting in *Homogenous Coordinates*.

The term *frustum* might be used, meaning the camera's visible area.

The combination of all of these matrices gives your object it's location, your world it's organization, and your viewpoint it's perspective. So, when you are writing a shader, you want to multiply your vertex coordinate (in model space), by the *ModelViewProjectionMatrix*, which can be utilized in a few different ways.

### ModelViewProjection matrix

If you are using an older version of openGL, you might have a built-in uniform variable available called `gl_ModelViewProjectionMatrix`, in which case, your vertex shader might have something like this:

```
gl_Position = gl_ModelViewProjectionMatrix * gl_Vertex;
```

This is a multiplication of your point in model space, by the MVP matrix. If you are using a more modern version of openGL, you need to calculate this yourself, and pass it into your shader using a uniform matrix.

### Calculating these matrices

If you plan on passing these matrices onto the shader manually, you will have to calculate them in your application. GLM is a library of mathematics tools for openGL, and you can read a little more about it in my notes [here][1]. Otherwise, since I use openFrameworks, I'll focus on how to accomplish this using oF. 

The *Projection Matrix* can be made using an openframeworks method, makePerspectiveMatrix(). There are a few similar methods within ofMatrix4x4, including getPerspectiveMatrix(), but that only concerns matrices that already hold perspective data.

```
void ofMatrix4x4::makePerspectiveMatrix(double fovy, double aspectRatio, double zNear, double zFar);

projection.makePerspectiveMatrix(ofDegToRad(45.f),ofGetWidth()/ofGetHeight(),0.1f,1.00f);
```

If you are using ofEasyCam, you can actually get the projection matrix from the camera object itself:

```
projection = cam.getProjectionMatrix();
```

Next, calculate the *Camera Matrix*. Once again, if you are using ofEasyCam, you can get this information from that object.

```
view = cam.getLocalTransformMatrix();
```

The *Model Matrix* simply requires an identity matrix.

```
model.makeIdentityMatrix();
```

And finally, you want to multiply all of these together for the ModelViewProjectionMatrix.

```
mvp = projection * view * model;
```

### Passing these matrices on to GLSL

We now have to make these available to the shader. After you begin your shader, begin passing each of these in as uniform variables.

```
shader.setUniformMatrix4f("M", model);
shader.setUniformMatrix4f("V", view);
shader.setUniformMatrix4f("P", projection);
shader.setUniformMatrix4f("MVP", mvp);
```

### Using these matrices within GLSL

Now that they are passed in, initialize the uniforms at the top of your vertex shader, and set the gl_Position using your new matrices. For now, I will be using gl_Vertex to access the current vertex position in model space, although I think that's only used in older versions.

```
#version 120

uniform M, V, P, MVP;

varying vec4 position;
varying vec2 texCoordVarying;

void main(){
    texCoordVarying = gl_MultiTexCoord0.xy;

    gl_Position = MVP * gl_Vertex;
}
```

Cool. Now I'll be moving onto the shading tutorial, where I'll actually get to use the light and camera to interact with the shader.

[1]: austinslominski.com/notebook/glsl-glm


