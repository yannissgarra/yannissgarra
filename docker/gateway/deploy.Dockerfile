FROM debian:bullseye-slim

# install ssh
RUN apt-get update && apt-get install -y --no-install-recommends openssh-client && apt-get clean