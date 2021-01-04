FROM nginx

ENV ACCEPT_EULA=Y

WORKDIR /code
COPY config.sh /

# Microsoft SQL Server Prerequisites
RUN ln -fs /usr/share/zoneinfo/America/Rio_Branco /etc/localtime && \
    dpkg-reconfigure --frontend noninteractive tzdata && \
    apt update && \
    echo "pt_BR.UTF-8 UTF-8" > /etc/locale.gen && \
    apt install -y ca-certificates \
                   apt-transport-https \
                   lsb-release \
                   gnupg2 \
                   ntp \
                   curl \
                   locales \
                   unzip \
                   software-properties-common \
                   gnupg2 \
                   libonig-dev \
                   unixodbc-dev && \
    locale-gen && \
    curl -o /etc/apt/trusted.gpg.d/php.gpg -fSL "https://packages.sury.org/php/apt.gpg" && \
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list && \
    curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && \
    curl -s https://packages.microsoft.com/config/ubuntu/20.04/prod.list > /etc/apt/sources.list.d/mssql-release.list && \
    apt update && \
    echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    locale-gen && \
    apt -y --no-install-recommends install msodbcsql17 mssql-tools && \
    apt -y install gcc g++ make autoconf libc-dev pkg-config  ntp php7.4 \
                   php7.4-fpm \
                   php7.4-mysql \
                   php7.4-mbstring \
                   php7.4-xmlrpc \
                   php7.4-soap \
                   php7.4-gd \
                   php7.4-xml \
                   php7.4-intl \
                   php7.4-dev && \
    apt upgrade -y && \
    apt autoremove -y && \
    apt clean && \
    rm -rf /var/lib/apt/lists/* && \
    pecl install sqlsrv pdo_sqlsrv xdebug && \
    printf "; priority=20\nextension=sqlsrv.so\n" > /etc/php/7.4/mods-available/sqlsrv.ini && \
    printf "; priority=30\nextension=pdo_sqlsrv.so\n" > /etc/php/7.4/mods-available/pdo_sqlsrv.ini && \
    phpenmod -v 7.4 sqlsrv pdo_sqlsrv  && \
    chown -R www-data:www-data /code && \
    chmod 755 /config.sh

COPY nginx/default.conf /etc/nginx/conf.d/default.conf
COPY nginx/php.ini /etc/php/7.4/fpm/php.ini
COPY nginx/nginx.conf /etc/nginx/
COPY nginx/www.conf /etc/php/7.4/fpm/pool.d/www.conf

CMD [ "/config.sh" ]
