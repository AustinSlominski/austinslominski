## Using GLM within openFrameworks

GLM is a mathematics library for openGL, and it is the current, proper way to calculate matrices and vectors for shaders.

[openFrameworks has a tutorial on this topic][1], explaining the syntax and how it differs from things like ofVec3f.

### Installation

First, download GLM from their [homepage][2]. Place it within openframeworks/lib/, and then link to it within your CoreOF.xcconfig file in libs/openFrameworksCompiled/project/osx/. The added lines should look like this:

```
HEADER_GLM = "$(OF_PATH)/libs/glm/glm"
```

And then add it to the OF_CORE_HEADERS:

```
OF_CORE_HEADERS = $(HEADER_OF) $(HEADER_POCO) $(HEADER_FREETYPE) $(HEADER_FREETYPE2) $(HEADER_FMODEX) $(HEADER_GLEW) $(HEADER_FREEIMAGE) $(HEADER_TESS2) $(HEADER_CAIRO) $(HEADER_RTAUDIO) $(HEADER_GLFW) $(HEADER_BOOST) $(HEADER_UTF8) $(HEADER_SSL) $(HEADER_GLM)
```

Now, finally, within your header, include it with the following:

```
#include "glm.hpp"
#include "gtc/matrix_transform.hpp"
```

### Usage

The syntax changes require using the glm namespace, and the types within them.

```
ofVec3f vector;
```

becomes,

```
glm::vec3 vector;
```

ofVec3f will still properly convert over to glm::vec3, but some functionality will be lost. Just know these two can potentially raise some issues if used interchangeably. For now I'm going to start using the glm syntax.




[1]: http://openframeworks.cc/learning/02_graphics/how_to_use_glm/
[2]: http://glm.g-truc.net/0.9.8/index.html