################################################################################
#
# fftw
#
################################################################################

FFTW3F_VERSION = 3.3.4
FFTW3F_SITE = http://www.fftw.org
FFTW3F_SOURCE = fftw-$(FFTW3F_VERSION).tar.gz
FFTW3F_INSTALL_STAGING = YES
FFTW3F_LICENSE = GPLv2+
FFTW3F_LICENSE_FILES = COPYING

FFTW3F_CONF_OPTS = --disable-fortran --enable-float

FFTW3F_CONF_OPTS += $(if $(BR2_PACKAGE_FFTW3F_PRECISION_SINGLE),--enable,--disable)-single
FFTW3F_CONF_OPTS += $(if $(BR2_PACKAGE_FFTW3F_PRECISION_LONG_DOUBLE),--enable,--disable)-long-double
FFTW3F_CONF_OPTS += $(if $(BR2_PACKAGE_FFTW3F_PRECISION_QUAD),--enable,--disable)-quad-precision

FFTW3F_CFLAGS = $(TARGET_CFLAGS)
ifeq ($(BR2_PACKAGE_FFTW3F_FAST),y)
FFTW3F_CFLAGS += -O3 -ffast-math
endif

# x86 optimisations
FFTW3F_CONF_OPTS += $(if $(BR2_PACKAGE_FFTW3F_USE_SSE),--enable,--disable)-sse
FFTW3F_CONF_OPTS += $(if $(BR2_PACKAGE_FFTW3F_USE_SSE2),--enable,--disable)-sse2

# ARM optimisations
FFTW3F_CONF_OPTS += $(if $(BR2_PACKAGE_FFTW3F_USE_NEON),--enable,--disable)-neon
FFTW3F_CFLAGS += $(if $(BR2_PACKAGE_FFTW3F_USE_NEON),-mfpu=neon)

# Generic optimisations
ifeq ($(BR2_TOOLCHAIN_HAS_THREADS),y)
FFTW3F_CONF_OPTS += --enable-threads --with-combined-threads
else
FFTW3F_CONF_OPTS += --disable-threads
endif
FFTW3F_CONF_OPTS += $(if $(BR2_GCC_ENABLE_OPENMP),--enable,--disable)-openmp

FFTW3F_CONF_OPTS += CFLAGS="$(FFTW3F_CFLAGS)"

$(eval $(autotools-package))
