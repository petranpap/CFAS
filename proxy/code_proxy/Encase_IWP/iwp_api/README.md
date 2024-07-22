# ENCASE IWP API


## Getting Started

In this repository we present the IWP_API , which is the main API that for connecting all the parts of the proxy together.

It runs on port 18082

In order to start it , you should edit AppConfig.ini and add your MongoDb credentials


And then move into the iwp_api directory and run 
```

gunicorn --bind=0.0.0.0:18082 proxy_api:dal --daemon

```

