#!/bin/bash
for branch in `git branch`; do
   git branch -D $branch
done