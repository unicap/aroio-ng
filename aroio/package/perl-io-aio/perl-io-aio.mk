################################################################################
#
# perl-io-aio
#
################################################################################

PERL_IO_AIO_VERSION = 4.34
PERL_IO_AIO_SOURCE = IO-AIO-$(PERL_IO_AIO_VERSION).tar.gz
PERL_IO_AIO_SITE = $(BR2_CPAN_MIRROR)/authors/id/M/ML/MLEHMANN
PERL_IO_AIO_DEPENDENCIES = host-perl-canary-stability perl-common-sense
PERL_IO_AIO_LICENSE_FILES = COPYING

$(eval $(perl-package))
