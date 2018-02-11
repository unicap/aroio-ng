################################################################################
#
# perl-io-captureoutput
#
################################################################################

PERL_IO_CAPTUREOUTPUT_VERSION = 1.1104
PERL_IO_CAPTUREOUTPUT_SOURCE = IO-CaptureOutput-$(PERL_IO_CAPTUREOUTPUT_VERSION).tar.gz
PERL_IO_CAPTUREOUTPUT_SITE = $(BR2_CPAN_MIRROR)/authors/id/D/DA/DAGOLDEN
PERL_IO_CAPTUREOUTPUT_LICENSE = Artistic or GPL-1.0+
PERL_IO_CAPTUREOUTPUT_LICENSE_FILES = LICENSE

$(eval $(host-perl-package))
