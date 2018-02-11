################################################################################
#
# perl-image-scale
#
################################################################################

PERL_IMAGE_SCALE_VERSION = 0.14
PERL_IMAGE_SCALE_SOURCE = Image-Scale-$(PERL_IMAGE_SCALE_VERSION).tar.gz
PERL_IMAGE_SCALE_SITE = $(BR2_CPAN_MIRROR)/authors/id/A/AG/AGRUNDMA
PERL_IMAGE_SCALE_LICENSE = gpl_2
PERL_IMAGE_SCALE_LICENSE_FILES = README

$(eval $(perl-package))
