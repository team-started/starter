FROM debian:stretch

# Install common system tools
RUN apt-get update -yqq \
    && apt-get install -yqq \
        zip \
    	curl \
    	wget \
    	jq \
    	ca-certificates \
    	apt-transport-https \
    	gnupg \
    && rm -rf /var/lib/apt/lists/*

# Enable PPA
RUN wget -q https://packages.sury.org/php/apt.gpg -O- | apt-key add - \
    && echo "deb https://packages.sury.org/php/ stretch main" | tee /etc/apt/sources.list.d/php.list \
    && rm -rf /var/lib/apt/lists/*

# Install PHP and composer
RUN apt-get update -yqq \
    && apt-get install -y --no-install-recommends \
        php7.2-cli \
        php7.2-curl \
        php7.2-dom \
        php7.2-fileinfo \
        php7.2-gd \
        php7.2-intl \
        php7.2-json \
        php7.2-mbstring \
        php7.2-mysqli \
        php7.2-opcache \
        php7.2-pdo \
        php7.2-simplexml \
        php7.2-soap \
        php7.2-tokenizer \
        php7.2-wddx \
        php7.2-xml \
        php7.2-xmlwriter \
        php7.2-zip \
    && rm -rf /var/lib/apt/lists/*

RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/cb19f2aa3aeaa2006c0cd69a7ef011eb31463067/web/installer -O - -q | php -- --version="1.8.4" --quiet --install-dir=/usr/local/bin --filename=composer
RUN composer global require hirak/prestissimo

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_NO_INTERACTION 1
