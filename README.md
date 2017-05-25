StreamSampler
=============

## Overview

CLI command that Receives a sample size and and optional stream, in order to generate a sample with thet received size.

## Usage

php app/console app:stream-sampler *sample_size* [*stream*]

Parameters:
* _sample_size_: length of the sample string
* _stream_: the stream from which to extract the sample. If no stream is given, it will be generated randomly.