################################################################################
#
# perl-audio-scan
#
################################################################################

PERL_AUDIO_SCAN_VERSION = 0.99
PERL_AUDIO_SCAN_SOURCE = Audio-Scan-$(PERL_AUDIO_SCAN_VERSION).tar.gz
PERL_AUDIO_SCAN_SITE = $(BR2_CPAN_MIRROR)/authors/id/A/AG/AGRUNDMA
PERL_AUDIO_SCAN_LICENSE_FILES = COPYING

$(eval $(perl-package))
