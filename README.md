StreamSampler
=============

## Overview

CLI command that Receives a sample size and and optional stream and generates a sample with the required size.

## Usage

```
php app/console app:stream-sampler *sample_size* [*stream-source*]
```
Parameters:
* _sample_size_:
length of the sample
* _stream-source_:
optional parameter to set the stream from which to extract the sample.
If the value is _file_ then the sampler service reads from the file, chunk by chunk, in order to generate the sample.
If no value is given, a stream will be generated randomly.

In order to take the stream from any other source, just run your command and pipe the result to the streamsampler.pl script in the lib folder:
```perl
cat lorem.txt | perl bin/streamsampler.pl 5
```

## TODO:

* Refactor the perl script to validate the size of the stream and be able to either use a streaming file for large inputs or send the stream directly to the sampler command.
* Separate the sample generation from the file reading.
* Implement a functional test for the symfony command.
* If there is no line feed the perl script hangs
