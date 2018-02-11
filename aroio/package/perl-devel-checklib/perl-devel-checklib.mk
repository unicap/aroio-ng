################################################################################
#
# perl-devel-checklib
#
################################################################################

PERL_DEVEL_CHECKLIB_VERSION = 1.11
PERL_DEVEL_CHECKLIB_SOURCE = Devel-CheckLib-$(PERL_DEVEL_CHECKLIB_VERSION).tar.gz
PERL_DEVEL_CHECKLIB_SITE = $(BR2_CPAN_MIRROR)/authors/id/M/MA/MATTN
HOST_PERL_DEVEL_CHECKLIB_DEPENDENCIES = host-perl-io-captureoutput host-perl-mock-config
PERL_DEVEL_CHECKLIB_LICENSE = Artistic or GPL-1.0+
PERL_DEVEL_CHECKLIB_LICENSE_FILES = README

$(eval $(host-perl-package))
